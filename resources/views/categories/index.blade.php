@extends('layouts.app')

@section('title', __('ui.browse_categories'))

@section('content')
<div class="ui-fade-in max-w-6xl">
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold tracking-tight">{{ __('ui.browse_categories') }}</h1>
        <div class="ui-muted mt-1">{{ __('ui.choose_category') }}</div>
    </div>

    <div class="pc-grid">
        @forelse($categories as $category)
            @if($category && $category->getName(app()->getLocale()))
                @php($minBudget = $category->min_budget ?? null)
                <a href="{{ localized_route('tasks.index') . '?category=' . $category->id }}" class="pc-card">
                    <div class="pc-card__media" aria-hidden="true">
                        @if(! empty($category->image_url))
                            <img src="{{ $category->image_url }}" alt="" class="pc-card__img" loading="lazy" decoding="async">
                        @else
                            <div class="pc-card__fallback">
                                <i class="fa-solid fa-{{ $category->icon ?? 'layer-group' }}"></i>
                            </div>
                        @endif
                    </div>
                    <div class="pc-card__body">
                        <div class="pc-card__title">{{ $category->getName(app()->getLocale()) }}</div>
                        <div class="pc-card__meta">
                            {{ __('ui.projects_starting_at', ['price' => ($minBudget ? number_format($minBudget).' '.__('tasks.currency') : __('ui.explore_projects'))]) }}
                        </div>
                    </div>
                </a>
            @endif
        @empty
            <div class="sm:col-span-2 lg:col-span-3">
                <div class="ui-empty">
                    <div class="ui-empty-body">
                        <div class="ui-badge"><i class="fa-solid fa-layer-group"></i></div>
                        <div class="text-sm font-extrabold text-slate-900 dark:text-white">{{ __('ui.no_categories_available') }}</div>
                        <div class="ui-muted">{{ __('ui.categories_coming_soon') }}</div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection
