@extends('layouts.app')

@section('title', __('ui.edit_profile'))

@section('content')
<div class="ui-fade-in max-w-4xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight">{{ __('ui.edit_profile') }}</h1>
            <div class="ui-muted mt-1">{{ __('ui.update_profile_hint') }}</div>
        </div>
        <a href="{{ localized_route('profile.show') }}" class="ui-btn ui-btn-secondary">
            <i class="fa-regular fa-eye"></i>
            <span class="truncate">{{ __('ui.view') }} {{ __('ui.profile') }}</span>
        </a>
    </div>

    <div class="ui-card">
        <div class="ui-card-body">
            <form method="POST" action="{{ localized_route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                    <div class="shrink-0">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="h-20 w-20 rounded-2xl object-cover shadow-sm ring-1 ring-slate-200/70 dark:ring-slate-800/70">
                        @else
                            <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-slate-100 text-slate-500 shadow-sm ring-1 ring-slate-200/70 dark:bg-slate-900/40 dark:text-slate-300 dark:ring-slate-800/70">
                                <i class="fa-regular fa-user text-2xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="min-w-0 flex-1">
                        <label class="ui-label" for="avatar">{{ __('ui.avatar') }}</label>
                        <input type="file" name="avatar" id="avatar" class="ui-input" accept="image/*">
                        @error('avatar')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                        <div class="ui-muted mt-1">{{ __('ui.avatar_hint') }}</div>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="ui-label">{{ __('ui.name') }}</label>
                        <input type="text" name="name" id="name" class="ui-input @error('name') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="ui-label">{{ __('ui.email') }}</label>
                        <input type="email" name="email" id="email" class="ui-input @error('email') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="ui-label">{{ __('ui.phone') }}</label>
                        <input type="text" name="phone" id="phone" class="ui-input @error('phone') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="ui-label">{{ __('ui.location') }}</label>
                        <input type="text" name="location" id="location" class="ui-input @error('location') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('location', $user->location) }}">
                        @error('location')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="bio" class="ui-label">{{ __('ui.personal_bio') }}</label>
                        <textarea name="bio" id="bio" rows="4" class="ui-input @error('bio') border-rose-300 dark:border-rose-800 @enderror">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($user->role === 'tasker')
                        <div class="sm:col-span-2">
                            <label for="skills" class="ui-label">{{ __('ui.skills_comma_separated') }}</label>
                            <input type="text" name="skills" id="skills" class="ui-input @error('skills') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('skills', $user->skills) }}" placeholder="{{ __('ui.skills_example') }}">
                            @error('skills')
                                <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="ui-card bg-white/60 dark:bg-slate-950/40">
                    <div class="p-5">
                        <div class="mb-4 flex items-center justify-between gap-3">
                            <div class="min-w-0">
                                <div class="text-sm font-extrabold text-slate-900 dark:text-white">{{ __('ui.security') }}</div>
                                <div class="ui-muted mt-1">{{ __('ui.password_change_hint') }}</div>
                            </div>
                            <span class="ui-badge"><i class="fa-solid fa-shield-halved"></i></span>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="password" class="ui-label">{{ __('ui.new_password_leave_blank') }}</label>
                                <input type="password" name="password" id="password" class="ui-input @error('password') border-rose-300 dark:border-rose-800 @enderror">
                                @error('password')
                                    <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="ui-label">{{ __('ui.confirm_password') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="ui-input">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ localized_route('profile.show') }}" class="ui-btn ui-btn-ghost justify-center">
                        <span class="truncate">{{ __('ui.cancel') }}</span>
                    </a>
                    <button type="submit" class="ui-btn ui-btn-primary justify-center">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span class="truncate">{{ __('ui.save_changes') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
