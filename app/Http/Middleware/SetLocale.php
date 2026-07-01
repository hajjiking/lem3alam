<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = config('app.supported_locales', ['ar', 'fr', 'en']);

        // Get locale from URL segment
        $locale = $request->segment(1);

        // If locale is in supported locales, set it
        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        } else {
            // Check if locale is stored in session
            $sessionLocale = Session::get('locale');
            if ($sessionLocale && in_array($sessionLocale, $supportedLocales)) {
                App::setLocale($sessionLocale);
            } else {
                // Fall back to default locale
                $defaultLocale = config('app.locale', 'ar');
                App::setLocale($defaultLocale);
                Session::put('locale', $defaultLocale);
            }
        }

        // Ensure route() automatically includes the locale parameter
        \Illuminate\Support\Facades\URL::defaults(['locale' => App::getLocale()]);

        // Set text direction for views
        view()->share('textDirection', App::getLocale() === 'ar' ? 'rtl' : 'ltr');

        return $next($request);
    }
}
