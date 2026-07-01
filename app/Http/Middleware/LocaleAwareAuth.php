<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LocaleAwareAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        // Get current locale from URL or session
        $locale = $request->segment(1);
        $supportedLocales = config('app.supported_locales', ['ar', 'fr', 'en']);

        if (! in_array($locale, $supportedLocales)) {
            $locale = App::getLocale();
        }

        // Redirect to localized login route
        return redirect()->guest(localized_route('login', [], $locale));
    }
}
