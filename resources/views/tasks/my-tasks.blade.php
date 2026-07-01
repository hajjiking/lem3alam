@extends('layouts.app')

@section('title', __('tasks.my_tasks'))

@section('content')
@php
    $role = auth()->user()->role;
    $statusOptions = ['open','in_progress','completed','cancelled'];
    $deleteTaskConfirmation = addslashes(__('tasks.delete_task_confirmation'));
@endphp

<div class="ui-fade-in max-w-6xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight">
                @if($role === 'client')
                    {{ __('tasks.tasks_i_posted') }}
                @else
                    {{ __('tasks.my_applications') }}
                @endif
            </h1>
            <div class="ui-muted mt-1">
                @if($role === 'client')
                    {{ __('tasks.manage_your_posted_tasks') }}
                @else
                    {{ __('tasks.my_applications') }}
                @endif
            </div>
        </div>

        <div class="flex flex-wrap gap-2">
            @if($role === 'client')
                <a href="{{ localized_route('tasks.create') }}" class="ui-btn ui-btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    <span class="truncate">{{ __('tasks.add_new_task') }}</span>
                </a>
            @endif
        </div>
    </div>

    <div class="ui-card mb-6">
        <div class="ui-card-body">
            <div class="flex flex-wrap gap-2">
                <a class="{{ request('status') ? 'ui-btn ui-btn-secondary' : 'ui-btn ui-btn-primary' }}" href="{{ localized_route('tasks.my', request()->except('status', 'page')) }}">
                    <span class="truncate">{{ __('tasks.all_statuses') }}</span>
                </a>
                @foreach($statusOptions as $st)
                    <a class="{{ request('status') === $st ? 'ui-btn ui-btn-primary' : 'ui-btn ui-btn-secondary' }}" href="{{ localized_route('tasks.my', array_merge(request()->except('page'), ['status' => $st])) }}">
                        <span class="truncate">{{ __("tasks.status_{$st}") }}</span>
                    </a>
                @endforeach
            </div>

            <div class="my-5 ui-divider"></div>

            <form id="filtersForm" method="GET" action="{{ localized_route('tasks.my') }}" class="grid gap-3 sm:grid-cols-[1fr_auto] sm:items-end">
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="q" class="ui-label">{{ __('tasks.search_tasks') }}</label>
                        <input id="q" type="text" class="ui-input" name="q" value="{{ request('q') }}" placeholder="{{ __('tasks.search_tasks') }}">
                    </div>
                    <div>
                        <label for="sort" class="ui-label">{{ __('ui.sort') }}</label>
                        <select id="sort" name="sort" class="ui-input" onchange="document.getElementById('filtersForm').submit()">
                            <option value="newest" {{ request('sort','newest')==='newest' ? 'selected' : '' }}>{{ __('tasks.newest_first') }}</option>
                            <option value="oldest" {{ request('sort')==='oldest' ? 'selected' : '' }}>{{ __('tasks.oldest_first') }}</option>
                            <option value="budget_high" {{ request('sort')==='budget_high' ? 'selected' : '' }}>{{ __('tasks.highest_budget') }}</option>
                            <option value="budget_low" {{ request('sort')==='budget_low' ? 'selected' : '' }}>{{ __('tasks.lowest_budget') }}</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="ui-btn ui-btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span class="truncate">{{ __('ui.search') }}</span>
                    </button>
                </div>
            </form>

            <div class="mt-4 ui-muted">
                @php $totalTasks = method_exists($tasks, 'total') ? $tasks->total() : $tasks->count(); @endphp
                <span class="ui-badge">{{ $totalTasks }}</span>
                <span>{{ __('tasks.tasks_found') }}</span>
            </div>
        </div>
    </div>

    @if($tasks->count() > 0)
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($tasks as $task)
                @php
                    $urgency = $task->urgency;
                    $urgencyClasses = [
                        'urgent' => 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/25 dark:text-rose-200',
                        'high' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/40 dark:bg-amber-900/25 dark:text-amber-200',
                        'medium' => 'border-sky-200 bg-sky-50 text-sky-700 dark:border-sky-900/40 dark:bg-sky-900/25 dark:text-sky-200',
                        'low' => 'border-slate-200 bg-slate-50 text-slate-700 dark:border-slate-800/70 dark:bg-slate-900/30 dark:text-slate-200',
                    ];
                @endphp

                <div class="ui-card">
                    <div class="ui-card-body flex h-full flex-col gap-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <a href="{{ localized_route('tasks.show', $task->id) }}" class="block truncate text-sm font-extrabold text-slate-900 hover:underline dark:text-white">
                                    {{ $task->title }}
                                </a>
                                <div class="ui-muted mt-1 line-clamp-2">{{ Str::limit($task->description, 120) }}</div>
                            </div>
                            <span class="ui-badge {{ $urgencyClasses[$urgency] ?? $urgencyClasses['low'] }}">{{ __("tasks.{$urgency}") }}</span>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <span class="ui-badge">
                                <i class="fa-solid fa-tag"></i>
                                <span class="truncate">{{ $task->category->name ?? __('tasks.not_specified') }}</span>
                            </span>
                            <span class="ui-badge">
                                <i class="fa-solid fa-coins"></i>
                                <span class="truncate">{{ number_format((float) $task->budget_min) }} - {{ number_format((float) $task->budget_max) }} {{ __('tasks.currency_symbol') }}</span>
                            </span>
                            @if($task->location)
                                <span class="ui-badge">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="truncate">{{ $task->location }}</span>
                                </span>
                            @else
                                <span class="ui-badge">
                                    <i class="fa-solid fa-globe"></i>
                                    <span class="truncate">{{ __('tasks.remote_work') }}</span>
                                </span>
                            @endif
                        </div>

                        <div class="grid gap-2 text-sm text-slate-600 dark:text-slate-300">
                            <div class="flex items-center justify-between gap-3">
                                <span class="font-semibold">{{ __('tasks.applications') }}</span>
                                <span class="ui-badge">{{ $task->applications_count ?? ($task->applications->count() ?? 0) }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="font-semibold">{{ __('tasks.created_at') }}</span>
                                <span class="ui-muted">{{ $task->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        @if($role === 'client')
                            <div class="flex flex-wrap gap-2">
                                @if($task->assigned_tasker_id)
                                    <span class="ui-badge border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/25 dark:text-emerald-200">
                                        <i class="fa-solid fa-user-check"></i>
                                        <span class="truncate">{{ $task->assignedTasker->name ?? __('tasks.not_specified') }}</span>
                                    </span>
                                @else
                                    <span class="ui-badge">
                                        <i class="fa-regular fa-user"></i>
                                        <span class="truncate">{{ __('tasks.not_assigned_yet') }}</span>
                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="flex flex-wrap gap-2">
                                <span class="ui-badge">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <span class="truncate">{{ $task->client->name ?? __('tasks.not_specified') }}</span>
                                </span>
                                @php($userApplication = $task->applications->where('tasker_id', auth()->id())->first())
                                @if($userApplication)
                                    <span class="ui-badge">
                                        <span class="truncate">{{ __("tasks.application_status_{$userApplication->status}") }}</span>
                                    </span>
                                @endif
                            </div>
                        @endif

                        <div class="mt-auto flex gap-2">
                            <a href="{{ localized_route('tasks.show', $task->id) }}" class="ui-btn ui-btn-primary flex-1">
                                <i class="fa-regular fa-eye"></i>
                                <span class="truncate">{{ __('ui.view_details') }}</span>
                            </a>

                            @if($role === 'client' && $task->status === 'open')
                                <a href="{{ localized_route('tasks.edit', $task->id) }}" class="ui-btn ui-btn-secondary">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <form method="POST" action="{{ localized_route('tasks.destroy', $task->id) }}" onsubmit="return confirm('{{ $deleteTaskConfirmation }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ui-btn ui-btn-secondary">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
    @else
        <div class="ui-empty">
            <div class="ui-empty-body">
                <div class="ui-badge"><i class="fa-regular fa-clipboard"></i></div>
                <div class="text-sm font-extrabold text-slate-900 dark:text-white">{{ __('tasks.no_tasks_found') }}</div>
                <div class="ui-muted">{{ __('tasks.try_adjust_filters') }}</div>
                @if($role === 'client')
                    <a href="{{ localized_route('tasks.create') }}" class="ui-btn ui-btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        <span class="truncate">{{ __('tasks.add_new_task') }}</span>
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
