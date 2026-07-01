@extends('layouts.app')

@section('title', __('auth.register_title'))

@section('content')
<div class="mx-auto w-full max-w-2xl">
    <div class="ui-card overflow-hidden">
        <div class="border-b border-slate-200/70 bg-gradient-to-br from-white to-slate-50 px-6 py-5 dark:border-slate-800/70 dark:from-slate-950 dark:to-slate-900/40">
            <h1 class="text-xl font-extrabold tracking-tight">{{ __('auth.register_title') }}</h1>
            <p class="ui-muted mt-1">{{ __('ui.create_account_subtitle') }}</p>
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

            <form method="POST" action="{{ localized_route('register') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="first_name" class="ui-label">{{ __('auth.first_name') }}</label>
                        <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" required autocomplete="given-name" class="ui-input">
                        @error('first_name')
                            <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="ui-label">{{ __('auth.last_name') }}</label>
                        <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" required autocomplete="family-name" class="ui-input">
                        @error('last_name')
                            <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="email" class="ui-label">{{ __('auth.email') }}</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="ui-input">
                        @error('email')
                            <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="ui-label">{{ __('auth.phone') }}</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required autocomplete="tel" class="ui-input">
                        @error('phone')
                            <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="user_type" class="ui-label">{{ __('auth.user_type') }}</label>
                    <select id="user_type" name="user_type" required class="ui-input">
                        <option value="">{{ __('auth.select_user_type') }}</option>
                        <option value="client" {{ old('user_type') == 'client' ? 'selected' : '' }}>{{ __('auth.client_description') }}</option>
                        <option value="tasker" {{ old('user_type') == 'tasker' ? 'selected' : '' }}>{{ __('auth.tasker_description') }}</option>
                    </select>
                    @error('user_type')
                        <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="password" class="ui-label">{{ __('auth.password') }}</label>
                        <input id="password" name="password" type="password" required autocomplete="new-password" class="ui-input">
                        @error('password')
                            <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="ui-label">{{ __('auth.confirm_password') }}</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="ui-input">
                    </div>
                </div>

                <label class="flex items-start gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-200">
                    <input type="checkbox" id="terms" name="terms" required class="mt-1 h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:ring-slate-800/50">
                    <span class="min-w-0">
                        {{ __('auth.agree_to') }}
                        <a href="{{ localized_route('terms') }}" class="underline decoration-slate-300 underline-offset-4 hover:text-slate-900 dark:decoration-slate-700 dark:hover:text-white">{{ __('auth.terms_conditions') }}</a>
                        {{ __('auth.and') }}
                        <a href="{{ localized_route('privacy') }}" class="underline decoration-slate-300 underline-offset-4 hover:text-slate-900 dark:decoration-slate-700 dark:hover:text-white">{{ __('auth.privacy_policy') }}</a>
                    </span>
                </label>
                @error('terms')
                    <div class="text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                @enderror

                <button type="submit" class="ui-btn ui-btn-primary w-full">
                    {{ __('auth.register_button') }}
                </button>

                <div class="pt-4 text-center">
                    <p class="ui-muted">{{ __('auth.already_have_account') }}</p>
                    <a href="{{ localized_route('login') }}" class="ui-btn ui-btn-ghost mt-2">{{ __('auth.login_button') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
