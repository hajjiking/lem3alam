@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="ui-muted">
            @if ($paginator->firstItem() !== null)
                <span class="ui-badge">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</span>
                <span class="ui-muted">/</span>
                <span class="ui-badge">{{ $paginator->total() }}</span>
            @endif
        </div>

        <div class="flex flex-wrap items-center justify-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="ui-btn ui-btn-secondary opacity-60" aria-disabled="true">
                    <span class="rtl:rotate-180">‹</span>
                    <span class="truncate">{{ __('pagination.previous') }}</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="ui-btn ui-btn-secondary">
                    <span class="rtl:rotate-180">‹</span>
                    <span class="truncate">{{ __('pagination.previous') }}</span>
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="ui-btn ui-btn-ghost opacity-60" aria-disabled="true">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="ui-btn ui-btn-primary" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="ui-btn ui-btn-secondary">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="ui-btn ui-btn-secondary">
                    <span class="truncate">{{ __('pagination.next') }}</span>
                    <span class="rtl:rotate-180">›</span>
                </a>
            @else
                <span class="ui-btn ui-btn-secondary opacity-60" aria-disabled="true">
                    <span class="truncate">{{ __('pagination.next') }}</span>
                    <span class="rtl:rotate-180">›</span>
                </span>
            @endif
        </div>
    </nav>
@endif
