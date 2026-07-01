<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('admin');
        $user = $guard->user();
        if (! $guard->check() || ! ($user instanceof User) || ! $user->isAdmin()) {
            if ($guard->check()) {
                $guard->logout();
            }

            return redirect()->route('admin.login')->withErrors([
                'error' => 'Access denied. Please login as admin.',
            ]);
        }

        if (app()->environment('testing')) {
            return $next($request);
        }

        if (! config('services.admin.two_factor_enabled')) {
            return $next($request);
        }

        if (! $request->session()->get('admin_2fa_passed')) {
            return redirect()->route('admin.otp.show');
        }

        return $next($request);
    }
}
