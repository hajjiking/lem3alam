<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminSessionTimeout
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('admin');
        if (! $guard->check()) {
            return $next($request);
        }

        $timeoutMinutes = (int) config('services.admin.session_timeout_minutes', 30);
        if ($timeoutMinutes <= 0) {
            return $next($request);
        }

        $now = now()->timestamp;
        $last = (int) $request->session()->get('admin_last_activity_at', $now);

        if (($now - $last) > ($timeoutMinutes * 60)) {
            $guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->withErrors([
                'error' => 'Session expired due to inactivity. Please login again.',
            ]);
        }

        $request->session()->put('admin_last_activity_at', $now);

        return $next($request);
    }
}

