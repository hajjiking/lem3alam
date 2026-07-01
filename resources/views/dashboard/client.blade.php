@extends('layouts.app')

@section('title', __('ui.client_dashboard.page_title') . ' - ' . __('ui.app_name'))

@section('content')
@php
    $user = auth()->user();
    $total = $user->tasks()->count();
    $completed = $user->tasks()->where('status', 'completed')->count();
    $inProgress = $user->tasks()->where('status', 'in_progress')->count();
    $open = $user->tasks()->where('status', 'open')->count();
    $recentTasks = $user->tasks()->latest()->take(5)->get();

    $statusPill = fn ($s) => match ($s) {
        'open' => 'border-sky-200 bg-sky-50 text-sky-700 dark:border-sky-900/40 dark:bg-sky-900/30 dark:text-sky-200',
        'in_progress' => 'border-amber-200 bg-amber-50 text-amber-900 dark:border-amber-900/40 dark:bg-amber-900/30 dark:text-amber-100',
        'completed' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-200',
        default => 'border-slate-200 bg-slate-50 text-slate-700 dark:border-slate-800/70 dark:bg-slate-900/40 dark:text-slate-200',
    };
@endphp

<div class="ui-fade-in max-w-6xl space-y-6">
    <div class="ui-card lg:hidden" data-dashboard-nav>
        <div class="ui-card-body flex gap-2 overflow-x-auto">
            <a href="{{ localized_route('dashboard.client') }}" class="ui-btn ui-btn-primary shrink-0">{{ __('ui.dashboard') }}</a>
            <a href="{{ localized_route('tasks.my') }}" class="ui-btn ui-btn-secondary shrink-0">{{ __('ui.my_tasks') }}</a>
            <a href="{{ localized_route('messages.index') }}" class="ui-btn ui-btn-secondary shrink-0">{{ __('ui.messages') }}</a>
            <a href="{{ localized_route('profile.edit') }}" class="ui-btn ui-btn-secondary shrink-0">{{ __('ui.profile') }}</a>
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
        <div class="ui-card lg:col-span-2">
            <div class="ui-card-body p-6 sm:p-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="min-w-0">
                        <span class="ui-badge border-slate-200 bg-white text-slate-700 dark:border-slate-800/70 dark:bg-slate-950 dark:text-slate-200">{{ __('ui.client_dashboard.badge') }}</span>
                        <h1 class="mt-3 text-2xl font-extrabold tracking-tight sm:text-3xl">{{ __('ui.client_dashboard.welcome', ['name' => $user->name]) }}</h1>
                        <p class="ui-muted mt-1 max-w-2xl">{{ __('ui.client_dashboard.subtitle') }}</p>
                    </div>
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                        <a href="{{ localized_route('tasks.create') }}" class="ui-btn ui-btn-primary">
                            <i class="fa-solid fa-plus" aria-hidden="true"></i>
                            <span>{{ __('ui.create_new_task') }}</span>
                        </a>
                        <a href="{{ localized_route('tasks.my') }}" class="ui-btn ui-btn-secondary">
                            <i class="fa-regular fa-clipboard" aria-hidden="true"></i>
                            <span>{{ __('ui.client_dashboard.view_my_tasks') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui-card">
            <div class="ui-card-body p-6">
                <div class="text-sm font-extrabold tracking-tight">{{ __('ui.client_dashboard.quick_actions') }}</div>
                <div class="ui-muted mt-1 text-sm">{{ __('ui.client_dashboard.quick_actions_hint') }}</div>
                <div class="mt-4 grid gap-2">
                    <a href="{{ localized_route('tasks.create') }}" class="ui-btn ui-btn-primary justify-start">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                        <span>{{ __('ui.create_new_task') }}</span>
                    </a>
                    <a href="{{ localized_route('tasks.my', ['status' => 'open']) }}" class="ui-btn ui-btn-secondary justify-start">
                        <i class="fa-regular fa-circle-dot" aria-hidden="true"></i>
                        <span>{{ __('ui.client_dashboard.open_tasks') }}</span>
                    </a>
                    <a href="{{ localized_route('messages.index') }}" class="ui-btn ui-btn-secondary justify-start">
                        <i class="fa-regular fa-message" aria-hidden="true"></i>
                        <span>{{ __('ui.client_dashboard.view_messages') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section aria-labelledby="clientDashboardOverview">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div class="min-w-0">
                <h2 id="clientDashboardOverview" class="text-lg font-extrabold tracking-tight">{{ __('ui.client_dashboard.overview') }}</h2>
                <p class="ui-muted mt-1">{{ __('ui.client_dashboard.overview_hint') }}</p>
            </div>
            <a href="{{ localized_route('tasks.my') }}" class="ui-btn ui-btn-secondary shrink-0">
                <span>{{ __('ui.client_dashboard.view_all') }}</span>
                <i class="fa-solid fa-arrow-right rtl:rotate-180" aria-hidden="true"></i>
            </a>
        </div>

        <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <div class="ui-card">
                <div class="ui-card-body">
                    <div class="flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <div class="ui-muted">{{ __('ui.client_dashboard.kpi_total') }}</div>
                            <div class="mt-2 text-2xl font-extrabold">{{ $total }}</div>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-600 dark:bg-slate-900/40 dark:text-slate-200">
                            <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-card">
                <div class="ui-card-body">
                    <div class="flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <div class="ui-muted">{{ __('ui.client_dashboard.kpi_open') }}</div>
                            <div class="mt-2 text-2xl font-extrabold">{{ $open }}</div>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-sky-50 text-sky-700 dark:bg-sky-900/30 dark:text-sky-200">
                            <i class="fa-regular fa-circle-dot" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-card">
                <div class="ui-card-body">
                    <div class="flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <div class="ui-muted">{{ __('ui.client_dashboard.kpi_in_progress') }}</div>
                            <div class="mt-2 text-2xl font-extrabold">{{ $inProgress }}</div>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-50 text-amber-900 dark:bg-amber-900/30 dark:text-amber-100">
                            <i class="fa-solid fa-person-walking" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-card">
                <div class="ui-card-body">
                    <div class="flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <div class="ui-muted">{{ __('ui.client_dashboard.kpi_completed') }}</div>
                            <div class="mt-2 text-2xl font-extrabold">{{ $completed }}</div>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-200">
                            <i class="fa-solid fa-check" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ui-card" aria-labelledby="clientDashboardRecent">
        <div class="flex flex-col gap-3 border-b border-slate-200/70 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-slate-800/70">
            <div class="min-w-0">
                <h2 id="clientDashboardRecent" class="text-base font-extrabold tracking-tight">{{ __('ui.client_dashboard.recent_title') }}</h2>
                <p class="ui-muted mt-1">{{ __('ui.client_dashboard.recent_hint') }}</p>
            </div>
            <a class="ui-btn ui-btn-secondary shrink-0" href="{{ localized_route('tasks.my') }}">{{ __('ui.client_dashboard.view_all') }}</a>
        </div>

        <div class="ui-card-body">
            @if($recentTasks->count() > 0)
                <div class="grid gap-3 md:hidden">
                    @foreach($recentTasks as $task)
                        <div class="rounded-2xl border border-slate-200/70 bg-white p-4 dark:border-slate-800/70 dark:bg-slate-950">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <a class="block truncate text-sm font-extrabold hover:underline" href="{{ localized_route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                    <div class="ui-muted mt-1 text-sm">{{ $task->created_at->format('Y-m-d') }}</div>
                                </div>
                                <span class="ui-badge {{ $statusPill($task->status) }}">{{ __("tasks.status_{$task->status}") }}</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between gap-3">
                                <div class="text-sm font-semibold">{{ number_format($task->budget, 2) }} MAD</div>
                                <div class="flex gap-2">
                                    <a class="ui-btn ui-btn-secondary px-3 py-2" href="{{ localized_route('tasks.show', $task->id) }}">{{ __('ui.client_dashboard.action_view') }}</a>
                                    <a class="ui-btn ui-btn-ghost px-3 py-2" href="{{ localized_route('tasks.edit', $task->id) }}">{{ __('ui.client_dashboard.action_edit') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="hidden overflow-x-auto md:block">
                    <table class="w-full min-w-[820px] text-sm">
                        <thead class="text-left text-slate-500 dark:text-slate-400">
                            <tr>
                                <th class="py-3 font-semibold">{{ __('ui.client_dashboard.table_title') }}</th>
                                <th class="py-3 font-semibold">{{ __('ui.client_dashboard.table_status') }}</th>
                                <th class="py-3 font-semibold">{{ __('ui.client_dashboard.table_budget') }}</th>
                                <th class="py-3 font-semibold">{{ __('ui.client_dashboard.table_created') }}</th>
                                <th class="py-3 font-semibold">{{ __('ui.client_dashboard.table_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200/70 dark:divide-slate-800/70">
                            @foreach($recentTasks as $task)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40">
                                    <td class="py-3 font-semibold">
                                        <a class="block max-w-[420px] truncate hover:underline" href="{{ localized_route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                    </td>
                                    <td class="py-3">
                                        <span class="ui-badge {{ $statusPill($task->status) }}">{{ __("tasks.status_{$task->status}") }}</span>
                                    </td>
                                    <td class="py-3">{{ number_format($task->budget, 2) }} MAD</td>
                                    <td class="py-3">{{ $task->created_at->format('Y-m-d') }}</td>
                                    <td class="py-3">
                                        <div class="flex gap-2">
                                            <a class="ui-btn ui-btn-secondary px-3 py-2" href="{{ localized_route('tasks.show', $task->id) }}">{{ __('ui.client_dashboard.action_view') }}</a>
                                            <a class="ui-btn ui-btn-ghost px-3 py-2" href="{{ localized_route('tasks.edit', $task->id) }}">{{ __('ui.client_dashboard.action_edit') }}</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-slate-200 p-10 text-center dark:border-slate-800">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-3xl bg-slate-100 text-slate-500 shadow-sm dark:bg-slate-900/40 dark:text-slate-200">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                    </div>
                    <div class="mt-4 text-base font-extrabold tracking-tight">{{ __('ui.client_dashboard.empty_title') }}</div>
                    <div class="ui-muted mt-1">{{ __('ui.client_dashboard.empty_body') }}</div>
                    <a href="{{ localized_route('tasks.create') }}" class="ui-btn ui-btn-primary mt-5">
                        <span>{{ __('ui.client_dashboard.empty_cta') }}</span>
                        <i class="fa-solid fa-arrow-right rtl:rotate-180" aria-hidden="true"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
