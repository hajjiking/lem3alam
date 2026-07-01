@extends('layouts.app')

@section('title', __('ui.profile'))

@section('content')
@php
    $role = $user->role;
    $roleClasses = [
        'client' => 'border-sky-200 bg-sky-50 text-sky-700 dark:border-sky-900/40 dark:bg-sky-900/25 dark:text-sky-200',
        'tasker' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/25 dark:text-emerald-200',
        'admin' => 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/25 dark:text-rose-200',
    ];
@endphp

<div class="ui-fade-in max-w-5xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight">{{ __('ui.profile') }}</h1>
            <div class="ui-muted mt-1 truncate">{{ $user->email }}</div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ localized_route('profile.edit') }}" class="ui-btn ui-btn-primary">
                <i class="fa-regular fa-pen-to-square"></i>
                <span class="truncate">{{ __('ui.edit_profile') }}</span>
            </a>
        </div>
    </div>

    <div class="ui-card">
        <div class="ui-card-body">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-start">
                <div class="mx-auto shrink-0 sm:mx-0">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="h-28 w-28 rounded-2xl object-cover shadow-sm ring-1 ring-slate-200/70 dark:ring-slate-800/70">
                    @else
                        <div class="flex h-28 w-28 items-center justify-center rounded-2xl bg-slate-100 text-slate-500 shadow-sm ring-1 ring-slate-200/70 dark:bg-slate-900/40 dark:text-slate-300 dark:ring-slate-800/70">
                            <i class="fa-regular fa-user text-3xl"></i>
                        </div>
                    @endif
                </div>

                <div class="min-w-0 flex-1 text-center sm:text-start">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0">
                            <div class="text-xl font-extrabold tracking-tight truncate">{{ $user->name }}</div>
                            <div class="mt-2 flex flex-wrap items-center justify-center gap-2 sm:justify-start">
                                <span class="ui-badge {{ $roleClasses[$role] ?? '' }}">{{ __('ui.' . $role) }}</span>
                                <span class="ui-badge">
                                    <i class="fa-regular fa-calendar"></i>
                                    <span class="truncate">{{ __('ui.registration_date') }}: {{ $user->created_at->translatedFormat('M Y') }}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($user->bio)
                        <div class="mt-4 text-slate-700 dark:text-slate-200">
                            <div class="ui-muted mb-1">{{ __('ui.personal_bio') }}</div>
                            <div class="whitespace-pre-line">{{ $user->bio }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="my-6 ui-divider"></div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="ui-card bg-white/60 dark:bg-slate-950/40">
                    <div class="p-4">
                        <div class="ui-muted">{{ __('ui.email') }}</div>
                        <div class="mt-1 truncate font-semibold text-slate-900 dark:text-white">{{ $user->email }}</div>
                    </div>
                </div>

                @if($user->phone)
                    <div class="ui-card bg-white/60 dark:bg-slate-950/40">
                        <div class="p-4">
                            <div class="ui-muted">{{ __('ui.phone') }}</div>
                            <div class="mt-1 truncate font-semibold text-slate-900 dark:text-white">{{ $user->phone }}</div>
                        </div>
                    </div>
                @endif

                @if($user->location)
                    <div class="ui-card bg-white/60 dark:bg-slate-950/40">
                        <div class="p-4">
                            <div class="ui-muted">{{ __('ui.location') }}</div>
                            <div class="mt-1 truncate font-semibold text-slate-900 dark:text-white">{{ $user->location }}</div>
                        </div>
                    </div>
                @endif

                @if($user->skills && $user->role === 'tasker')
                    <div class="ui-card bg-white/60 dark:bg-slate-950/40 sm:col-span-2">
                        <div class="p-4">
                            <div class="ui-muted mb-2">{{ __('ui.skills') }}</div>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $user->skills) as $skill)
                                    <span class="ui-badge border-purple-200 bg-purple-50 text-purple-700 dark:border-purple-900/40 dark:bg-purple-900/25 dark:text-purple-200">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
