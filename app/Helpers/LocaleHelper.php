<?php

if (! function_exists('localized_route')) {
    function localized_route($name, $parameters = [], $locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        // Ensure parameters is always an array
        if (! is_array($parameters)) {
            $parameters = [$parameters];
        }

        $parameters = array_merge(['locale' => $locale], $parameters);

        return route($name, $parameters);
    }
}

if (! function_exists('switch_locale_url')) {
    function switch_locale_url($locale)
    {
        $currentUrl = request()->url();
        $segments = explode('/', parse_url($currentUrl, PHP_URL_PATH));

        // Remove existing locale from URL if present
        $supportedLocales = config('app.supported_locales', ['ar', 'fr', 'en']);
        if (count($segments) > 1 && in_array($segments[1], $supportedLocales)) {
            array_splice($segments, 1, 1);
        }

        // Add new locale
        array_splice($segments, 1, 0, $locale);

        return url(implode('/', $segments));
    }
}
