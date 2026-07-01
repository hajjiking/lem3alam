@extends('layouts.app')

@section('title', __('auth.login'))

@section('content')
<div class="mx-auto w-full max-w-md">
    <div class="ui-card overflow-hidden">
        <div class="border-b border-slate-200/70 bg-gradient-to-br from-white to-slate-50 px-6 py-5 dark:border-slate-800/70 dark:from-slate-950 dark:to-slate-900/40">
            <h1 class="text-xl font-extrabold tracking-tight">{{ __('auth.login') }}</h1>
            <p class="ui-muted mt-1">{{ __('ui.welcome_back') ?? 'Welcome back' }}</p>
        </div>

        <div class="ui-card-body">
            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-100">
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ localized_route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="ui-label">{{ __('auth.email') }}</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        class="ui-input"
                    >
                    @error('email')
                        <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password" class="ui-label">{{ __('auth.password') }}</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        class="ui-input"
                    >
                    @error('password')
                        <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center justify-between gap-3">
                    <label class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:ring-slate-800/50">
                        {{ __('auth.remember_me') }}
                    </label>
                    <a href="{{ localized_route('password.request') }}" class="text-sm font-semibold text-slate-700 underline decoration-slate-300 underline-offset-4 hover:text-slate-900 dark:text-slate-200 dark:decoration-slate-700 dark:hover:text-white">
                        {{ __('auth.forgot_password') }}
                    </a>
                </div>

                <button type="submit" class="ui-btn ui-btn-primary w-full">
                    {{ __('auth.login_button') }}
                </button>

                <div class="grid gap-2 pt-2">
                    <a href="{{ localized_route('social.redirect', ['provider' => 'google']) }}" class="ui-btn ui-btn-secondary w-full">
                        <span aria-hidden="true">G</span>
                        Google
                    </a>
                    <a href="{{ localized_route('social.redirect', ['provider' => 'facebook']) }}" class="ui-btn ui-btn-secondary w-full">
                        <span aria-hidden="true">f</span>
                        Facebook
                    </a>
                    <a href="{{ localized_route('social.redirect', ['provider' => 'apple']) }}" class="ui-btn ui-btn-secondary w-full">
                        <span aria-hidden="true"></span>
                        Apple
                    </a>
                </div>

                <div class="pt-4 text-center">
                    <p class="ui-muted">{{ __('auth.no_account') }}</p>
                    <a href="{{ localized_route('register') }}" class="ui-btn ui-btn-ghost mt-2">
                        {{ __('auth.create_account') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
