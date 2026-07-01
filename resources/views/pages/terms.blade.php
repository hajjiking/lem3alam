@extends('layouts.app')

@section('title', __('ui.terms'))

@section('content')
<div class="ui-fade-in mx-auto w-full max-w-4xl space-y-6">
    <div class="ui-card overflow-hidden">
        <div class="border-b border-slate-200/70 bg-gradient-to-br from-white to-slate-50 px-6 py-5 dark:border-slate-800/70 dark:from-slate-950 dark:to-slate-900/40">
            <h1 class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.title') }}</h1>
            <p class="ui-muted mt-1">{{ __('ui.terms_page.updated', ['date' => now()->translatedFormat('F d, Y')]) }}</p>
        </div>

        <div class="ui-card-body space-y-6 text-sm leading-7 text-slate-700 dark:text-slate-200">
            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s1_title') }}</h2>
                <p>{{ __('ui.terms_page.s1_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s2_title') }}</h2>
                <p>{{ __('ui.terms_page.s2_body') }}</p>
            </section>

            <section class="space-y-4">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s3_title') }}</h2>

                <div class="space-y-2">
                    <h3 class="text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s3_registration_title') }}</h3>
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach((array) trans('ui.terms_page.s3_registration_items') as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-2">
                    <h3 class="text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s3_responsibilities_title') }}</h3>
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach((array) trans('ui.terms_page.s3_responsibilities_items') as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s4_title') }}</h2>
                <p>{{ __('ui.terms_page.s4_intro') }}</p>
                <ul class="list-disc space-y-1 ps-5">
                    @foreach((array) trans('ui.terms_page.s4_items') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="space-y-4">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s5_title') }}</h2>

                <div class="space-y-2">
                    <h3 class="text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s5_clients_title') }}</h3>
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach((array) trans('ui.terms_page.s5_clients_items') as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-2">
                    <h3 class="text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s5_taskers_title') }}</h3>
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach((array) trans('ui.terms_page.s5_taskers_items') as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s6_title') }}</h2>
                <ul class="list-disc space-y-1 ps-5">
                    @foreach((array) trans('ui.terms_page.s6_items') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s7_title') }}</h2>
                <p>{{ __('ui.terms_page.s7_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s8_title') }}</h2>
                <p>
                    {{ __('ui.terms_page.s8_body') }}
                    <a href="{{ localized_route('privacy') }}" class="font-semibold text-slate-900 underline decoration-slate-300 underline-offset-4 hover:text-slate-700 dark:text-white dark:decoration-slate-700 dark:hover:text-slate-200">
                        {{ __('ui.privacy') }}
                    </a>
                    .
                </p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s9_title') }}</h2>
                <ul class="list-disc space-y-1 ps-5">
                    @foreach((array) trans('ui.terms_page.s9_items') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s10_title') }}</h2>
                <p>{{ __('ui.terms_page.s10_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s11_title') }}</h2>
                <p>{{ __('ui.terms_page.s11_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s12_title') }}</h2>
                <p>{{ __('ui.terms_page.s12_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s13_title') }}</h2>
                <p>{{ __('ui.terms_page.s13_body') }}</p>
            </section>

            <section class="space-y-2">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s14_title') }}</h2>
                <p>{{ __('ui.terms_page.s14_body') }}</p>
            </section>

            <section class="space-y-3">
                <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('ui.terms_page.s15_title') }}</h2>
                <p>{{ __('ui.terms_page.s15_intro') }}</p>
                <div class="grid gap-2 rounded-2xl border border-slate-200/70 bg-slate-50/60 p-4 dark:border-slate-800/70 dark:bg-slate-950/30">
                    <div class="flex items-center justify-between gap-3">
                        <span class="ui-muted text-xs font-semibold">{{ __('ui.terms_page.s15_email_label') }}</span>
                        <a href="mailto:{{ __('ui.terms_page.s15_email_value') }}" class="text-xs font-semibold text-slate-900 underline decoration-slate-300 underline-offset-4 hover:text-slate-700 dark:text-white dark:decoration-slate-700 dark:hover:text-slate-200">{{ __('ui.terms_page.s15_email_value') }}</a>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <span class="ui-muted text-xs font-semibold">{{ __('ui.terms_page.s15_phone_label') }}</span>
                        <span class="text-xs font-semibold text-slate-900 dark:text-white">{{ __('ui.terms_page.s15_phone_value') }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="ui-muted text-xs font-semibold">{{ __('ui.terms_page.s15_address_label') }}</span>
                        <span class="text-xs font-semibold text-slate-900 dark:text-white">{{ __('ui.terms_page.s15_address_value') }}</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
