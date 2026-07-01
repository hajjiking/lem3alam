@php
    $locale = app()->getLocale();
@endphp

<div class="inline-flex rounded-xl border border-slate-200 bg-white p-1 shadow-sm dark:border-slate-800 dark:bg-slate-950">
    <a
        href="{{ route('language.switch', 'ar') }}"
        class="{{ $locale === 'ar' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white' }} inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition"
        aria-current="{{ $locale === 'ar' ? 'page' : 'false' }}"
    >
        <span aria-hidden="true">🇸🇦</span>
        <span class="hidden sm:inline">{{ __('ui.lang_arabic') }}</span>
        <span class="sm:hidden">ع</span>
    </a>
    <a
        href="{{ route('language.switch', 'fr') }}"
        class="{{ $locale === 'fr' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white' }} inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition"
        aria-current="{{ $locale === 'fr' ? 'page' : 'false' }}"
    >
        <span aria-hidden="true">🇫🇷</span>
        <span class="hidden sm:inline">{{ __('ui.lang_french') }}</span>
        <span class="sm:hidden">Fr</span>
    </a>
    <a
        href="{{ route('language.switch', 'en') }}"
        class="{{ $locale === 'en' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white' }} inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition"
        aria-current="{{ $locale === 'en' ? 'page' : 'false' }}"
    >
        <span aria-hidden="true">🇺🇸</span>
        <span class="hidden sm:inline">{{ __('ui.lang_english') }}</span>
        <span class="sm:hidden">En</span>
    </a>
</div>
