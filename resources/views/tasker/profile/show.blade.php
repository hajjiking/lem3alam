@extends('layouts.app')

@section('title', $tasker->name . ' - ' . __('Tasker Profile'))

@section('content')
<div class="ui-fade-in max-w-6xl space-y-6">
    <div class="ui-card overflow-hidden">
        <div class="ui-card-body">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-start">
                <div class="mx-auto shrink-0 sm:mx-0">
                    <div class="h-32 w-32 overflow-hidden rounded-full border border-slate-200/70 bg-slate-100 shadow-sm dark:border-slate-800/70 dark:bg-slate-900/40 sm:h-40 sm:w-40">
                        @if($tasker->profile_image)
                            <img src="{{ Storage::url($tasker->profile_image) }}" alt="{{ $tasker->name }}" class="h-full w-full object-cover" loading="eager" decoding="async">
                        @else
                            <div class="flex h-full w-full items-center justify-center text-slate-400">
                                <i class="fa-regular fa-user text-4xl" aria-hidden="true"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="min-w-0 flex-1 text-center sm:text-start">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0">
                            <h1 class="truncate text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-3xl">{{ $tasker->name }}</h1>

                            <div class="mt-3 flex flex-wrap justify-center gap-2 sm:justify-start">
                                @if($tasker->city)
                                    <span class="ui-badge">
                                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                                        <span class="truncate">{{ $tasker->city }}</span>
                                    </span>
                                @endif
                                @if($tasker->category)
                                    <span class="ui-badge">
                                        <i class="fa-solid fa-briefcase" aria-hidden="true"></i>
                                        <span class="truncate">{{ $tasker->category->name }}</span>
                                    </span>
                                @endif
                            </div>

                            @if($tasker->hourly_rate)
                                <div class="mt-4">
                                    <span class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ number_format($tasker->hourly_rate, 2) }} DH</span>
                                    <span class="ui-muted">/ {{ __('hour') }}</span>
                                </div>
                            @endif
                        </div>

                        @if($tasker->rating > 0)
                            <div class="mx-auto w-full max-w-[220px] rounded-2xl border border-slate-200/70 bg-white/60 p-4 shadow-sm backdrop-blur dark:border-slate-800/60 dark:bg-slate-950/40 sm:mx-0">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ number_format($tasker->rating, 1) }}</div>
                                    <i class="fa-solid fa-star text-amber-400" aria-hidden="true"></i>
                                </div>
                                <div class="mt-2 flex justify-center gap-0.5" aria-hidden="true">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star text-xs {{ $i <= floor($tasker->rating) ? 'text-amber-400' : ($i <= ceil($tasker->rating) ? 'text-amber-200' : 'text-slate-200 dark:text-slate-700') }}"></i>
                                    @endfor
                                </div>
                                <div class="ui-muted mt-2 text-center text-xs font-semibold">{{ $tasker->total_reviews }} {{ __('reviews') }}</div>
                            </div>
                        @endif
                    </div>

                    @if($tasker->getBio())
                        <div class="ui-muted mt-6 max-w-3xl text-sm leading-7">
                            {{ $tasker->getBio() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="border-t border-slate-200/70 bg-slate-50/60 px-6 py-5 dark:border-slate-800/70 dark:bg-slate-950/30">
            <div class="grid gap-3 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-200/70 bg-white/60 p-4 dark:border-slate-800/60 dark:bg-slate-950/40">
                    <div class="ui-muted text-xs font-semibold">{{ __('Tasks Completed') }}</div>
                    <div class="mt-2 text-2xl font-extrabold tracking-tight">{{ $tasker->tasks_completed ?? 0 }}</div>
                </div>
                <div class="rounded-2xl border border-slate-200/70 bg-white/60 p-4 dark:border-slate-800/60 dark:bg-slate-950/40">
                    <div class="ui-muted text-xs font-semibold">{{ __('Verified Skills') }}</div>
                    <div class="mt-2 text-2xl font-extrabold tracking-tight">{{ $tasker->verifiedSkills()->count() }}</div>
                </div>
                <div class="rounded-2xl border border-slate-200/70 bg-white/60 p-4 dark:border-slate-800/60 dark:bg-slate-950/40">
                    <div class="ui-muted text-xs font-semibold">{{ __('Member Since') }}</div>
                    <div class="mt-2 text-2xl font-extrabold tracking-tight">{{ $tasker->created_at->format('M Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            @if($skills->count() > 0)
                <div class="ui-card">
                    <div class="ui-card-body">
                        <div class="flex items-center gap-2 text-base font-extrabold tracking-tight text-slate-900 dark:text-white">
                            <i class="fa-solid fa-screwdriver-wrench text-slate-400" aria-hidden="true"></i>
                            <span>{{ __('Skills') }}</span>
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($skills as $skill)
                                <span class="ui-badge">
                                    <span class="truncate">{{ $skill->getName() }}</span>
                                    @if($skill->pivot->experience_level)
                                        <span class="ui-muted ms-1 text-xs">· {{ ucfirst($skill->pivot->experience_level) }}</span>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if($portfolioItems->count() > 0)
                <div class="ui-card">
                    <div class="ui-card-body">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-base font-extrabold tracking-tight text-slate-900 dark:text-white">
                                <i class="fa-regular fa-images text-slate-400" aria-hidden="true"></i>
                                <span>{{ __('Portfolio') }}</span>
                            </div>
                        </div>

                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            @foreach($portfolioItems as $item)
                                <div class="overflow-hidden rounded-2xl border border-slate-200/70 bg-white/60 shadow-sm dark:border-slate-800/60 dark:bg-slate-950/40">
                                    @if($item->getImageUrl())
                                        <div class="aspect-[16/10] bg-slate-100 dark:bg-slate-900">
                                            <img src="{{ $item->getImageUrl() }}" alt="{{ $item->image_alt ?: $item->title }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <div class="truncate text-sm font-extrabold text-slate-900 dark:text-white">{{ $item->title }}</div>
                                        <div class="ui-muted mt-1 line-clamp-2 text-sm">{{ Str::limit($item->getDescription(), 100) }}</div>
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @if($item->category)
                                                <span class="ui-badge">{{ $item->category->getName() }}</span>
                                            @endif
                                            @if($item->tags && count($item->tags) > 0)
                                                @foreach(array_slice($item->tags, 0, 2) as $tag)
                                                    <span class="ui-muted text-xs font-semibold">#{{ $tag }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($portfolioItems->hasPages())
                            <div class="mt-6">
                                {{ $portfolioItems->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if($reviews->count() > 0)
                <div class="ui-card">
                    <div class="ui-card-body">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-base font-extrabold tracking-tight text-slate-900 dark:text-white">
                                <i class="fa-solid fa-star text-amber-400" aria-hidden="true"></i>
                                <span>{{ __('Reviews') }}</span>
                            </div>
                            <a href="{{ route('reviews.index', ['tasker' => $tasker->id]) }}" class="ui-btn ui-btn-ghost">
                                <span>{{ __('View All') }}</span>
                                <i class="fa-solid fa-arrow-right rtl:rotate-180" aria-hidden="true"></i>
                            </a>
                        </div>

                        <div class="mt-5 space-y-4">
                            @foreach($reviews as $review)
                                <div class="rounded-2xl border border-slate-200/70 bg-white/60 p-4 dark:border-slate-800/60 dark:bg-slate-950/40">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex min-w-0 items-center gap-3">
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm dark:bg-white dark:text-slate-900">
                                                {{ substr($review->client->name, 0, 1) }}
                                            </div>
                                            <div class="min-w-0">
                                                <div class="truncate text-sm font-extrabold text-slate-900 dark:text-white">{{ $review->client->name }}</div>
                                                <div class="ui-muted mt-0.5 text-xs font-semibold">{{ $review->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                        <div class="flex gap-0.5" aria-hidden="true">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa-solid fa-star text-sm {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200 dark:text-slate-700' }}"></i>
                                            @endfor
                                        </div>
                                    </div>

                                    @if($review->comment)
                                        <div class="ui-muted mt-3 text-sm leading-7">{{ $review->getComment() }}</div>
                                    @endif

                                    @if($review->task)
                                        <div class="mt-3 inline-flex items-center gap-2 rounded-2xl border border-slate-200/70 bg-slate-50/60 px-3 py-2 text-xs font-semibold text-slate-700 dark:border-slate-800/70 dark:bg-slate-950/30 dark:text-slate-200">
                                            <i class="fa-solid fa-check text-emerald-400" aria-hidden="true"></i>
                                            <span class="truncate">{{ __('Task') }}: {{ $review->task->title }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="ui-card sticky top-24">
                <div class="ui-card-body">
                    <div class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Contact Tasker') }}</div>

                    <div class="mt-4 space-y-2">
                        @auth
                            @if(auth()->user()->isClient())
                                <button type="button" class="ui-btn ui-btn-primary w-full justify-center">
                                    <i class="fa-regular fa-message" aria-hidden="true"></i>
                                    <span>{{ __('Send Message') }}</span>
                                </button>
                                <button type="button" class="ui-btn ui-btn-secondary w-full justify-center">
                                    <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                                    <span>{{ __('Hire for Task') }}</span>
                                </button>
                            @else
                                <div class="rounded-2xl border border-slate-200/70 bg-slate-50/60 p-4 text-center text-sm text-slate-700 dark:border-slate-800/70 dark:bg-slate-950/30 dark:text-slate-200">
                                    {{ __('You need a client account to hire this tasker.') }}
                                </div>
                            @endif
                        @else
                            <div class="rounded-2xl border border-slate-200/70 bg-slate-50/60 p-4 text-center dark:border-slate-800/70 dark:bg-slate-950/30">
                                <div class="ui-muted text-sm">{{ __('Please login to contact this tasker') }}</div>
                                <a href="{{ localized_route('login') }}" class="ui-btn ui-btn-primary mt-4 w-full justify-center">{{ __('Login') }}</a>
                            </div>
                        @endauth
                    </div>

                    <div class="my-5 ui-divider"></div>

                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="ui-muted">{{ __('Response Rate') }}</span>
                            <span class="font-semibold text-slate-900 dark:text-white">100%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="ui-muted">{{ __('Last Active') }}</span>
                            <span class="font-semibold text-emerald-300">{{ __('Online Now') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
