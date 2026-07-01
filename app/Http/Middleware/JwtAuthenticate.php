<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $auth = $request->header('Authorization');
        if (! $auth || ! str_starts_with($auth, 'Bearer ')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $token = substr($auth, 7);
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return response()->json(['success' => false, 'message' => 'Invalid token'], 401);
        }
        $header = json_decode(self::b64($parts[0]), true);
        $payload = json_decode(self::b64($parts[1]), true);
        $signature = $parts[2];
        $secret = (string) config('services.messaging.jwt_secret');
        if (! $secret) {
            return response()->json(['success' => false, 'message' => 'Server misconfigured'], 500);
        }
        $data = $parts[0].'.'.$parts[1];
        $calc = rtrim(strtr(base64_encode(hash_hmac('sha256', $data, $secret, true)), '+/', '-_'), '=');
        if ($calc !== $signature) {
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 401);
        }
        if (isset($payload['exp']) && time() >= $payload['exp']) {
            return response()->json(['success' => false, 'message' => 'Token expired'], 401);
        }
        $request->attributes->set('jwt_user_id', (int) ($payload['sub'] ?? 0));

        return $next($request);
    }

    private static function b64(string $v): string
    {
        return base64_decode(strtr($v, '-_', '+/')) ?: '';
    }
}
