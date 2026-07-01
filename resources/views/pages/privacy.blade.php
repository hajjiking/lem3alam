@extends('layouts.app')

@section('title', __('ui.privacy'))

@section('content')
<div class="ui-fade-in mx-auto w-full max-w-4xl space-y-6">
    <div class="ui-card overflow-hidden">
        <div class="border-b border-slate-200/70 bg-gradient-to-br from-white to-slate-50 px-6 py-5 dark:border-slate-800/70 dark:from-slate-950 dark:to-slate-900/40">
            <h1 class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.title') }}</h1>
            <p class="ui-muted mt-1">{{ __('ui.privacy_page.updated', ['date' => now()->translatedFormat('F d, Y')]) }}</p>
        </div>

        <div class="ui-card-body space-y-6 text-sm leading-7 text-slate-700 dark:text-slate-200">
            <section class="space-y-3">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s1_title') }}</h2>
                <p>{{ __('ui.privacy_page.s1_intro') }}</p>

                <div class="space-y-2">
                    <h3 class="text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s1_personal_title') }}</h3>
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach((array) trans('ui.privacy_page.s1_personal_items') as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-2">
                    <h3 class="text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s1_usage_title') }}</h3>
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach((array) trans('ui.privacy_page.s1_usage_items') as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s2_title') }}</h2>
                <p>{{ __('ui.privacy_page.s2_intro') }}</p>
                <ul class="list-disc space-y-1 ps-5">
                    @foreach((array) trans('ui.privacy_page.s2_items') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s3_title') }}</h2>
                <p>{{ __('ui.privacy_page.s3_intro') }}</p>
                <ul class="list-disc space-y-1 ps-5">
                    @foreach((array) trans('ui.privacy_page.s3_items') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s4_title') }}</h2>
                <p>{{ __('ui.privacy_page.s4_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s5_title') }}</h2>
                <p>{{ __('ui.privacy_page.s5_intro') }}</p>
                <ul class="list-disc space-y-1 ps-5">
                    @foreach((array) trans('ui.privacy_page.s5_items') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s6_title') }}</h2>
                <p>{{ __('ui.privacy_page.s6_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s7_title') }}</h2>
                <p>{{ __('ui.privacy_page.s7_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s8_title') }}</h2>
                <p>{{ __('ui.privacy_page.s8_body') }}</p>
            </section>

            <section class="space-y-3">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.privacy_page.s9_title') }}</h2>
                <p>{{ __('ui.privacy_page.s9_intro') }}</p>
                <div class="grid gap-2 rounded-2xl border border-slate-200/70 bg-slate-50/60 p-4 dark:border-slate-800/70 dark:bg-slate-950/30">
                    <div class="flex items-center justify-between gap-3">
                        <span class="ui-muted text-xs font-semibold">{{ __('ui.privacy_page.s9_email_label') }}</span>
                        <a href="mailto:{{ __('ui.privacy_page.s9_email_value') }}" class="text-xs font-semibold text-slate-900 underline decoration-slate-300 underline-offset-4 hover:text-slate-700 dark:text-white dark:decoration-slate-700 dark:hover:text-slate-200">{{ __('ui.privacy_page.s9_email_value') }}</a>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <span class="ui-muted text-xs font-semibold">{{ __('ui.privacy_page.s9_phone_label') }}</span>
                        <span class="text-xs font-semibold text-slate-900 dark:text-white">{{ __('ui.privacy_page.s9_phone_value') }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="ui-muted text-xs font-semibold">{{ __('ui.privacy_page.s9_address_label') }}</span>
                        <span class="text-xs font-semibold text-slate-900 dark:text-white">{{ __('ui.privacy_page.s9_address_value') }}</span>
                    </div>
                </div>

                <div class="ui-muted text-xs">
                    <a href="{{ localized_route('terms') }}" class="font-semibold text-slate-900 underline decoration-slate-300 underline-offset-4 hover:text-slate-700 dark:text-white dark:decoration-slate-700 dark:hover:text-slate-200">{{ __('ui.terms') }}</a>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
