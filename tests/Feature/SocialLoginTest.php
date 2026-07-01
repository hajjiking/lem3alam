<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class SocialLoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('services.google.client_id', 'google-client-id');
        Config::set('services.google.client_secret', 'google-client-secret');
        Config::set('services.google.redirect', 'http://localhost/auth/google/callback');

        Config::set('services.facebook.client_id', 'facebook-client-id');
        Config::set('services.facebook.client_secret', 'facebook-client-secret');
        Config::set('services.facebook.redirect', 'http://localhost/auth/facebook/callback');
    }

    public function test_redirect_generates_correct_url_for_google()
    {
        $response = $this->get(route('social.redirect', ['locale' => 'en', 'provider' => 'google']));

        $response->assertRedirect();
        $targetUrl = $response->headers->get('Location');
        $this->assertStringContainsString('https://accounts.google.com/o/oauth2/v2/auth', $targetUrl);
        $this->assertStringContainsString('client_id=google-client-id', $targetUrl);
        $this->assertStringContainsString('state=', $targetUrl);
    }

    public function test_callback_creates_new_user_and_logs_in()
    {
        $state = Str::random(32);
        session()->put('oauth_state_google', $state);

        Http::fake([
            'oauth2.googleapis.com/token' => Http::response([
                'access_token' => 'test-access-token',
                'id_token' => 'test-id-token',
            ], 200),
            'oauth2.googleapis.com/tokeninfo*' => Http::response([
                'aud' => 'google-client-id',
            ], 200),
            'openidconnect.googleapis.com/v1/userinfo' => Http::response([
                'sub' => '123456789',
                'name' => 'Test User',
                'email' => 'test@example.com',
            ], 200),
        ]);

        $response = $this->get(route('social.callback', [
            'locale' => 'en',
            'provider' => 'google',
            'code' => 'test-code',
            'state' => $state,
        ]));

        $response->assertRedirect(route('dashboard', ['locale' => 'en']));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);
        $this->assertDatabaseHas('social_accounts', [
            'provider' => 'google',
            'provider_id' => '123456789',
        ]);
    }

    public function test_callback_links_account_for_existing_authenticated_user()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['email' => 'existing@example.com']);
        $this->actingAs($user);

        $state = Str::random(32);
        session()->put('oauth_state_google', $state);

        Http::fake([
            'oauth2.googleapis.com/token' => Http::response([
                'access_token' => 'test-access-token',
                'id_token' => 'test-id-token',
            ], 200),
            'oauth2.googleapis.com/tokeninfo*' => Http::response([
                'aud' => 'google-client-id',
            ], 200),
            'openidconnect.googleapis.com/v1/userinfo' => Http::response([
                'sub' => '987654321',
                'name' => 'Google User',
                'email' => 'google@example.com',
            ], 200),
        ]);

        $response = $this->get(route('social.callback', [
            'locale' => 'en',
            'provider' => 'google',
            'code' => 'test-code',
            'state' => $state,
        ]));

        $response->assertRedirect(route('profile.show', ['locale' => 'en']));

        $this->assertDatabaseHas('social_accounts', [
            'user_id' => $user->id,
            'provider' => 'google',
            'provider_id' => '987654321',
        ]);
    }

    public function test_callback_fails_with_invalid_state()
    {
        session()->put('oauth_state_google', 'valid-state');

        $response = $this->get(route('social.callback', [
            'locale' => 'en',
            'provider' => 'google',
            'code' => 'test-code',
            'state' => 'invalid-state',
        ]));

        $response->assertRedirect(route('login', ['locale' => 'en']));
        $response->assertSessionHasErrors('oauth');
    }
}
