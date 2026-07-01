@extends('layouts.app')

@section('title', $category && $category->getName(app()->getLocale()) ? $category->getName(app()->getLocale()) : __('ui.category'))

@section('content')
<div class="ui-fade-in max-w-6xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div class="min-w-0">
            <h1 class="truncate text-2xl font-extrabold tracking-tight">{{ $category && $category->getName(app()->getLocale()) ? $category->getName(app()->getLocale()) : __('ui.category') }}</h1>
            <div class="ui-muted mt-1">{{ $category && $category->getDescription(app()->getLocale()) ? $category->getDescription(app()->getLocale()) : __('ui.no_description') }}</div>
        </div>
        <div class="flex flex-wrap gap-2">
            <span class="ui-badge">
                <i class="fa-regular fa-clipboard"></i>
                <span class="truncate">{{ $tasks->total() }} {{ __('ui.tasks_available') }}</span>
            </span>
            <a href="{{ localized_route('categories.index') }}" class="ui-btn ui-btn-secondary">
                <i class="fa-solid fa-arrow-left rtl:rotate-180"></i>
                <span class="truncate">{{ __('ui.browse_categories') }}</span>
            </a>
        </div>
    </div>

    @if($subcategories->count() > 0)
        <div class="mb-8">
            <div class="mb-3 text-sm font-extrabold text-slate-900 dark:text-white">{{ __('ui.subcategories') ?? 'Subcategories' }}</div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($subcategories as $subcategory)
                    @if($subcategory && $subcategory->getName(app()->getLocale()))
                        <a href="{{ localized_route('categories.show', $subcategory->id) }}" class="ui-card transition hover:shadow-md">
                            <div class="ui-card-body flex items-center gap-3">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm dark:bg-white dark:text-slate-900" style="{{ $subcategory->color ? 'background:' . $subcategory->color . '; color: white;' : '' }}">
                                    @if($subcategory->icon)
                                        <i class="fa-solid fa-{{ $subcategory->icon }}"></i>
                                    @else
                                        <i class="fa-solid fa-layer-group"></i>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="truncate text-sm font-extrabold text-slate-900 dark:text-white">{{ $subcategory->getName(app()->getLocale()) }}</div>
                                    <div class="ui-muted mt-1 truncate">{{ $subcategory->getDescription(app()->getLocale()) }}</div>
                                </div>
                                <i class="fa-solid fa-chevron-right rtl:rotate-180 text-slate-400"></i>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="mb-3 text-sm font-extrabold text-slate-900 dark:text-white">{{ __('ui.available_tasks') ?? __('ui.tasks') }}</div>

    @if($tasks->count() > 0)
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($tasks as $task)
                <div class="ui-card">
                    <div class="ui-card-body flex h-full flex-col gap-4">
                        <div class="min-w-0">
                            <div class="truncate text-sm font-extrabold text-slate-900 dark:text-white">{{ $task->getTitle() }}</div>
                            <div class="ui-muted mt-1 line-clamp-2">{{ Str::limit($task->getDescription(), 140) }}</div>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            @if($task->location)
                                <span class="ui-badge">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="truncate">{{ $task->location }}</span>
                                </span>
                            @endif
                            <span class="ui-badge">
                                <i class="fa-solid fa-coins"></i>
                                <span class="truncate">{{ number_format((float) $task->budget_min) }} - {{ number_format((float) $task->budget_max) }} {{ __('tasks.currency_symbol') ?? 'MAD' }}</span>
                            </span>
                            @if($task->is_remote)
                                <span class="ui-badge">
                                    <i class="fa-solid fa-globe"></i>
                                    <span class="truncate">{{ __('tasks.remote_work') ?? 'Remote' }}</span>
                                </span>
                            @endif
                            <span class="ui-badge">
                                <i class="fa-regular fa-clock"></i>
                                <span class="truncate">{{ $task->created_at->diffForHumans() }}</span>
                            </span>
                        </div>

                        <div class="mt-auto">
                            <a href="{{ localized_route('tasks.show', $task->id) }}" class="ui-btn ui-btn-primary w-full">
                                <span class="truncate">{{ __('ui.view_details') ?? __('ui.view_tasks') }}</span>
                                <i class="fa-solid fa-arrow-right rtl:rotate-180"></i>
                            </a>
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
                <div class="ui-badge"><i class="fa-regular fa-circle-xmark"></i></div>
                <div class="text-sm font-extrabold text-slate-900 dark:text-white">{{ __('ui.no_tasks_found') ?? __('tasks.no_tasks_found') ?? 'No tasks found' }}</div>
                <div class="ui-muted">{{ __('ui.try_again_later') ?? __('Try again later or browse other categories.') }}</div>
                <a href="{{ localized_route('categories.index') }}" class="ui-btn ui-btn-primary">
                    <span class="truncate">{{ __('ui.browse_categories') }}</span>
                    <i class="fa-solid fa-arrow-right rtl:rotate-180"></i>
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
