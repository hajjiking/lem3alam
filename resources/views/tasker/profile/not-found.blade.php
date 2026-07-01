@extends('layouts.app')

@section('title', __('ui.profile') )

@section('content')
<div class="ui-fade-in max-w-3xl">
    <div class="ui-card">
        <div class="ui-card-body p-8 text-center">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-3xl bg-slate-100 text-slate-400 shadow-sm dark:bg-slate-900/40">
                <i class="fa-solid fa-user-slash text-4xl" aria-hidden="true"></i>
            </div>

            <h1 class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Profile Not Available') }}</h1>
            <div class="ui-muted mx-auto mt-2 max-w-md text-sm leading-7">{{ __('This tasker profile could not be found or is not available.') }}</div>

            <div class="mt-8 flex flex-col justify-center gap-2 sm:flex-row">
                <a href="{{ localized_route('home') }}" class="ui-btn ui-btn-primary">
                    <i class="fa-solid fa-house" aria-hidden="true"></i>
                    <span>{{ __('ui.back') }}</span>
                </a>
                <a href="{{ localized_route('tasks.index') }}" class="ui-btn ui-btn-secondary">
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    <span>{{ __('ui.browse_tasks') }}</span>
                </a>
                <a href="{{ localized_route('categories.index') }}" class="ui-btn ui-btn-secondary">
                    <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                    <span>{{ __('ui.browse_categories') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
