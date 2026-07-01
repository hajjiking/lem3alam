@extends('layouts.app')

@section('title', __('tasks.browse_tasks'))

@section('content')
@php
    $q = request('search');
    $selectedCategory = request('category');
    $location = request('location');
    $urgency = request('urgency');
    $budgetMin = request('budget_min');
    $budgetMax = request('budget_max');
    $isRemote = request('is_remote');

    $urgencyLabel = fn ($v) => match ($v) {
        'low' => __('tasks.priority_low'),
        'medium' => __('tasks.priority_medium'),
        'high' => __('tasks.priority_high'),
        'urgent' => __('tasks.priority_urgent'),
        default => $v,
    };

    $urgencyPill = fn ($v) => match ($v) {
        'urgent' => 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-200',
        'high' => 'border-amber-200 bg-amber-50 text-amber-900 dark:border-amber-900/40 dark:bg-amber-900/30 dark:text-amber-100',
        'medium' => 'border-sky-200 bg-sky-50 text-sky-700 dark:border-sky-900/40 dark:bg-sky-900/30 dark:text-sky-200',
        'low' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-200',
        default => 'border-slate-200 bg-slate-50 text-slate-700 dark:border-slate-800/70 dark:bg-slate-900/40 dark:text-slate-200',
    };
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight">{{ __('tasks.browse_tasks') }}</h1>
            <p class="ui-muted mt-1">{{ __('tasks.search_and_filter') }}</p>
        </div>
        @auth
            @if (auth()->user()->role === 'client')
                <a href="{{ localized_route('tasks.create') }}" class="ui-btn ui-btn-primary">{{ __('ui.create_task') }}</a>
            @endif
        @endauth
    </div>

    <div class="ui-card">
        <div class="ui-card-body">
            <form method="GET" action="{{ localized_route('tasks.index') }}" class="grid grid-cols-1 gap-3 md:grid-cols-12">
                <div class="md:col-span-5">
                    <label class="ui-label">{{ __('ui.search') }}</label>
                    <input name="search" value="{{ $q }}" class="ui-input" placeholder="{{ __('tasks.search_placeholder') }}">
                </div>

                <div class="md:col-span-3">
                    <label class="ui-label">{{ __('tasks.category') ?? __('ui.categories') }}</label>
                    <select name="category" class="ui-input">
                        <option value="">{{ __('tasks.all_categories') }}</option>
                        @foreach($categories as $category)
                            @if($category)
                                <option value="{{ $category->id }}" {{ (string) $selectedCategory === (string) $category->id ? 'selected' : '' }}>
                                    {{ $category->getName(app()->getLocale()) }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-4">
                    <label class="ui-label">{{ __('tasks.location') }}</label>
                    <input name="location" value="{{ $location }}" class="ui-input" placeholder="{{ __('tasks.location') }}">
                </div>

                <div class="md:col-span-3">
                    <label class="ui-label">{{ __('tasks.urgency') }}</label>
                    <select name="urgency" class="ui-input">
                        <option value="">{{ __('tasks.all_priorities') }}</option>
                        <option value="low" {{ $urgency === 'low' ? 'selected' : '' }}>{{ __('tasks.priority_low') }}</option>
                        <option value="medium" {{ $urgency === 'medium' ? 'selected' : '' }}>{{ __('tasks.priority_medium') }}</option>
                        <option value="high" {{ $urgency === 'high' ? 'selected' : '' }}>{{ __('tasks.priority_high') }}</option>
                        <option value="urgent" {{ $urgency === 'urgent' ? 'selected' : '' }}>{{ __('tasks.priority_urgent') }}</option>
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label class="ui-label">{{ __('tasks.budget_min') }}</label>
                    <input name="budget_min" value="{{ $budgetMin }}" class="ui-input" inputmode="decimal" placeholder="0">
                </div>

                <div class="md:col-span-3">
                    <label class="ui-label">{{ __('tasks.budget_max') }}</label>
                    <input name="budget_max" value="{{ $budgetMax }}" class="ui-input" inputmode="decimal" placeholder="∞">
                </div>

                <div class="md:col-span-3">
                    <label class="ui-label">{{ __('ui.type') }}</label>
                    <select name="is_remote" class="ui-input">
                        <option value="">{{ __('tasks.all_work_types') }}</option>
                        <option value="1" {{ $isRemote === '1' ? 'selected' : '' }}>{{ __('tasks.remote_work') }}</option>
                        <option value="0" {{ $isRemote === '0' ? 'selected' : '' }}>{{ __('tasks.onsite_work') }}</option>
                    </select>
                </div>

                <div class="md:col-span-12 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-end">
                    <a href="{{ localized_route('tasks.index') }}" class="ui-btn ui-btn-secondary">{{ __('ui.clear_filters') }}</a>
                    <button type="submit" class="ui-btn ui-btn-primary">{{ __('ui.search') }}</button>
                </div>
            </form>
        </div>
    </div>

    @if($tasks->count() === 0)
        <div class="ui-card">
            <div class="ui-card-body">
                <div class="rounded-2xl border border-dashed border-slate-200 p-10 text-center dark:border-slate-800">
                    <div class="text-3xl">⌁</div>
                    <div class="mt-3 text-base font-extrabold tracking-tight">{{ __('ui.no_results') ?? 'No results' }}</div>
                    <div class="ui-muted mt-1">{{ __('tasks.no_tasks_found') ?? 'Try changing your filters.' }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            @foreach($tasks as $task)
                <div class="ui-card">
                    <div class="ui-card-body">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <a href="{{ localized_route('tasks.show', $task->id) }}" class="block text-base font-extrabold tracking-tight hover:underline">
                                    {{ $task->title }}
                                </a>
                                <div class="ui-muted mt-1 line-clamp-2">{{ $task->description }}</div>
                            </div>
                            <div class="shrink-0">
                                <span class="ui-badge {{ $urgencyPill($task->urgency) }}">{{ $urgencyLabel($task->urgency) }}</span>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2">
                            @if($task->category)
                                <span class="ui-badge">{{ $task->category->getName(app()->getLocale()) }}</span>
                            @endif
                            <span class="ui-badge">{{ $task->is_remote ? __('tasks.remote_work') : __('tasks.onsite_work') }}</span>
                            <span class="ui-badge">{{ $task->city ?? $task->location ?? __('tasks.location') }}</span>
                        </div>

                        <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div class="text-sm font-extrabold">
                                {{ number_format($task->budget, 2) }} {{ __('tasks.currency') }}
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ localized_route('tasks.show', $task->id) }}" class="ui-btn ui-btn-secondary px-3 py-2">{{ __('ui.view') }}</a>
                                @auth
                                    @if(auth()->user()->role === 'tasker' && $task->status === 'open')
                                        <form action="{{ localized_route('tasks.apply', $task->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="ui-btn ui-btn-primary px-3 py-2">{{ __('ui.apply') ?? 'Apply' }}</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-2">
            {{ $tasks->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
