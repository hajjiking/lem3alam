@extends('layouts.app')

@section('title', __('My Portfolio'))

@section('content')
<div class="ui-fade-in max-w-6xl space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div class="min-w-0">
            <h1 class="truncate text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('My Portfolio') }}</h1>
            <div class="ui-muted mt-1">{{ __('Showcase your best work to attract more clients') }}</div>
        </div>
        <a href="{{ localized_route('tasker.portfolio.create') }}" class="ui-btn ui-btn-primary">
            <i class="fa-solid fa-plus" aria-hidden="true"></i>
            <span>{{ __('Add Portfolio Item') }}</span>
        </a>
    </div>

    @if($portfolioItems->count() > 0)
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($portfolioItems as $item)
                <div class="ui-card overflow-hidden">
                    <div class="aspect-[16/10] bg-slate-100 dark:bg-slate-900">
                        @if($item->image_path)
                            <img src="{{ $item->getImageUrl() }}" alt="{{ $item->image_alt ?? $item->title }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
                        @else
                            <div class="flex h-full w-full items-center justify-center text-slate-300 dark:text-slate-700">
                                <i class="fa-regular fa-image text-4xl" aria-hidden="true"></i>
                            </div>
                        @endif
                    </div>

                    <div class="ui-card-body flex flex-col gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            @if($item->status === 'active')
                                <span class="ui-badge border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/25 dark:text-emerald-200">{{ __('Active') }}</span>
                            @elseif($item->status === 'draft')
                                <span class="ui-badge border-amber-200 bg-amber-50 text-amber-800 dark:border-amber-900/40 dark:bg-amber-900/25 dark:text-amber-200">{{ __('Draft') }}</span>
                            @else
                                <span class="ui-badge border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/25 dark:text-rose-200">{{ __('Inactive') }}</span>
                            @endif
                            @if($item->is_featured)
                                <span class="ui-badge">
                                    <i class="fa-solid fa-star text-amber-400" aria-hidden="true"></i>
                                    <span>{{ __('Featured') }}</span>
                                </span>
                            @endif
                        </div>

                        <div class="min-w-0">
                            <div class="truncate text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $item->title }}</div>
                            <div class="ui-muted mt-1 line-clamp-2 text-sm leading-6">{{ $item->getDescription() }}</div>
                        </div>

                        @if($item->tags && count($item->tags) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($item->tags, 0, 3) as $tag)
                                    <span class="ui-badge">{{ $tag }}</span>
                                @endforeach
                                @if(count($item->tags) > 3)
                                    <span class="ui-muted text-xs font-semibold">+{{ count($item->tags) - 3 }}</span>
                                @endif
                            </div>
                        @endif

                        <div class="flex items-center justify-between gap-2 pt-2">
                            <div class="ui-muted text-xs font-semibold">
                                <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                <span>{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ localized_route('tasker.portfolio.edit', $item->id) }}" class="ui-btn ui-btn-secondary">
                                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                                    <span>{{ __('Edit') }}</span>
                                </a>
                                <form action="{{ localized_route('tasker.portfolio.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this portfolio item?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ui-btn ui-btn-ghost">
                                        <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                        <span>{{ __('Delete') }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($portfolioItems->hasPages())
            <div>
                {{ $portfolioItems->links() }}
            </div>
        @endif
    @else
        <div class="ui-card">
            <div class="ui-card-body p-10 text-center">
                <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-3xl bg-slate-100 text-slate-400 shadow-sm dark:bg-slate-900/40">
                    <i class="fa-regular fa-images text-4xl" aria-hidden="true"></i>
                </div>
                <div class="mt-6 text-lg font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('No portfolio items yet') }}</div>
                <div class="ui-muted mx-auto mt-2 max-w-md">{{ __('Start showcasing your work by adding your first portfolio item.') }}</div>
                <a href="{{ localized_route('tasker.portfolio.create') }}" class="ui-btn ui-btn-primary mt-6">
                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                    <span>{{ __('Add Your First Portfolio Item') }}</span>
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
