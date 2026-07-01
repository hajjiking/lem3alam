<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminPermissionMiddleware
{
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = Auth::guard('admin')->user();
        if (! $user instanceof User || ! $user->isAdmin()) {
            return redirect()->route('admin.login')->withErrors([
                'error' => 'Access denied. Please login as admin.',
            ]);
        }

        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        if (empty($permissions)) {
            return $next($request);
        }

        if (! $user->hasAnyPermission($permissions)) {
            abort(403);
        }

        return $next($request);
    }
}

