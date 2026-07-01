<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    protected array $providers = ['google', 'facebook', 'apple'];

    public function redirect(Request $request, $locale, string $provider)
    {
        if (! in_array($provider, $this->providers)) {
            abort(404);
        }

        $state = Str::random(32);
        $request->session()->put('oauth_state_'.$provider, $state);

        switch ($provider) {
            case 'google':
                $query = http_build_query([
                    'client_id' => Config::get('services.google.client_id'),
                    'redirect_uri' => Config::get('services.google.redirect'),
                    'response_type' => 'code',
                    'scope' => 'openid email profile',
                    'state' => $state,
                    'prompt' => 'select_account consent',
                    'access_type' => 'offline',
                ]);

                return redirect('https://accounts.google.com/o/oauth2/v2/auth?'.$query);

            case 'facebook':
                $query = http_build_query([
                    'client_id' => Config::get('services.facebook.client_id'),
                    'redirect_uri' => Config::get('services.facebook.redirect'),
                    'response_type' => 'code',
                    'scope' => 'email,public_profile',
                    'state' => $state,
                ]);

                return redirect('https://www.facebook.com/v18.0/dialog/oauth?'.$query);

            case 'apple':
                $query = http_build_query([
                    'response_type' => 'code',
                    'response_mode' => 'query',
                    'client_id' => Config::get('services.apple.client_id'),
                    'redirect_uri' => Config::get('services.apple.redirect'),
                    'scope' => 'name email',
                    'state' => $state,
                ]);

                return redirect('https://appleid.apple.com/auth/authorize?'.$query);
        }
    }

    public function callback(Request $request, $locale, string $provider)
    {
        if (! in_array($provider, $this->providers)) {
            abort(404);
        }

        $expectedState = $request->session()->pull('oauth_state_'.$provider);
        if (! $expectedState || $expectedState !== $request->get('state')) {
            return redirect()->route('login', ['locale' => $locale])->withErrors(['oauth' => 'Invalid OAuth state.']);
        }

        $code = $request->get('code');
        if (! $code) {
            return redirect()->route('login', ['locale' => $locale])->withErrors(['oauth' => 'Missing authorization code.']);
        }

        try {
            if ($provider === 'google') {
                $tokenResp = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                    'client_id' => Config::get('services.google.client_id'),
                    'client_secret' => Config::get('services.google.client_secret'),
                    'code' => $code,
                    'redirect_uri' => Config::get('services.google.redirect'),
                    'grant_type' => 'authorization_code',
                ])->throw()->json();

                $idToken = $tokenResp['id_token'] ?? null;
                $accessToken = $tokenResp['access_token'] ?? null;
                if (! $idToken || ! $accessToken) {
                    throw new \RuntimeException('Google token exchange failed');
                }

                $tokenInfo = Http::get('https://oauth2.googleapis.com/tokeninfo', ['id_token' => $idToken])->throw()->json();
                if (($tokenInfo['aud'] ?? null) !== Config::get('services.google.client_id')) {
                    throw new \RuntimeException('Invalid Google token audience');
                }

                $userinfo = Http::withToken($accessToken)->get('https://openidconnect.googleapis.com/v1/userinfo')->throw()->json();

                return $this->loginOrLink($locale, 'google', $userinfo['sub'] ?? $userinfo['id'] ?? null, $userinfo['email'] ?? null, $userinfo['name'] ?? null);
            }

            if ($provider === 'facebook') {
                $tokenResp = Http::get('https://graph.facebook.com/v18.0/oauth/access_token', [
                    'client_id' => Config::get('services.facebook.client_id'),
                    'client_secret' => Config::get('services.facebook.client_secret'),
                    'code' => $code,
                    'redirect_uri' => Config::get('services.facebook.redirect'),
                ])->throw()->json();

                $accessToken = $tokenResp['access_token'] ?? null;
                if (! $accessToken) {
                    throw new \RuntimeException('Facebook token exchange failed');
                }

                $userinfo = Http::get('https://graph.facebook.com/me', [
                    'fields' => 'id,name,email',
                    'access_token' => $accessToken,
                ])->throw()->json();

                return $this->loginOrLink($locale, 'facebook', $userinfo['id'] ?? null, $userinfo['email'] ?? null, $userinfo['name'] ?? null);
            }

            if ($provider === 'apple') {
                $clientSecret = $this->generateAppleClientSecret();
                $tokenResp = Http::asForm()->post('https://appleid.apple.com/auth/token', [
                    'client_id' => Config::get('services.apple.client_id'),
                    'client_secret' => $clientSecret,
                    'code' => $code,
                    'redirect_uri' => Config::get('services.apple.redirect'),
                    'grant_type' => 'authorization_code',
                ])->throw()->json();

                $idToken = $tokenResp['id_token'] ?? null;
                if (! $idToken) {
                    throw new \RuntimeException('Apple token exchange failed');
                }

                $claims = $this->decodeJwt($idToken);
                if (($claims['aud'] ?? null) !== Config::get('services.apple.client_id')) {
                    throw new \RuntimeException('Invalid Apple token audience');
                }
                $email = $claims['email'] ?? null;
                $name = $request->input('name') ?: null;

                return $this->loginOrLink($locale, 'apple', $claims['sub'] ?? null, $email, $name);
            }
        } catch (\Throwable $e) {
            Log::error('OAuth callback failed', ['provider' => $provider, 'error' => $e->getMessage()]);

            return redirect()->route('login', ['locale' => $locale])->withErrors(['oauth' => 'Authentication failed.']);
        }
    }

    protected function loginOrLink($locale, string $provider, ?string $providerId, ?string $email, ?string $name)
    {
        if (! $providerId) {
            return redirect()->route('login', ['locale' => $locale])->withErrors(['oauth' => 'Missing provider identifier.']);
        }

        $account = SocialAccount::where('provider', $provider)->where('provider_id', $providerId)->first();
        if ($account && $account->user) {
            Auth::loginUsingId($account->user_id, true);

            return redirect()->route('dashboard', ['locale' => $locale]);
        }

        if (Auth::check()) {
            $account = SocialAccount::updateOrCreate([
                'provider' => $provider,
                'provider_id' => $providerId,
            ], [
                'user_id' => Auth::id(),
                'email' => $email,
                'name' => $name,
            ]);

            return redirect()->route('profile.show', ['locale' => $locale]);
        }

        $user = null;
        if ($email) {
            $user = User::where('email', $email)->first();
        }
        if (! $user) {
            $user = User::create([
                'name' => $name ?: 'User',
                'email' => $email ?: Str::uuid().'@example.local',
                'password' => bcrypt(Str::random(32)),
                'role' => 'client',
            ]);
        }

        SocialAccount::updateOrCreate([
            'provider' => $provider,
            'provider_id' => $providerId,
        ], [
            'user_id' => $user->id,
            'email' => $email,
            'name' => $name,
        ]);

        Auth::loginUsingId($user->id, true);

        return redirect()->route('dashboard', ['locale' => $locale]);
    }

    protected function generateAppleClientSecret(): string
    {
        $teamId = Config::get('services.apple.team_id');
        $keyId = Config::get('services.apple.key_id');
        $clientId = Config::get('services.apple.client_id');
        $privateKey = Config::get('services.apple.private_key');

        $header = base64_encode(json_encode(['alg' => 'ES256', 'kid' => $keyId]));
        $now = time();
        $payload = base64_encode(json_encode([
            'iss' => $teamId,
            'iat' => $now,
            'exp' => $now + 3600,
            'aud' => 'https://appleid.apple.com',
            'sub' => $clientId,
        ]));
        $data = $header.'.'.$payload;
        $signature = '';
        $pkey = openssl_pkey_get_private($privateKey);
        openssl_sign($data, $signature, $pkey, OPENSSL_ALGO_SHA256);

        return $data.'.'.base64_encode($signature);
    }

    protected function decodeJwt(string $jwt): array
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return [];
        }

        return json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true) ?: [];
    }
}
