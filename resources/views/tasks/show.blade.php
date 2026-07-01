@extends('layouts.app')

@section('title', $task->getTitle())

@section('content')
@php
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

    $method = $task->payment_method ?? 'cash';
    $methodLabel = match ($method) {
        'card' => __('tasks.payment_method_card'),
        'online' => __('tasks.payment_method_online'),
        default => __('tasks.payment_method_cash'),
    };
@endphp

<div class="space-y-6">
    <div class="ui-card overflow-hidden">
        <div class="relative border-b border-slate-200/70 bg-gradient-to-br from-slate-900 to-slate-800 px-6 py-6 text-white dark:border-slate-800/70">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="ui-badge border-white/20 bg-white/10 text-white">{{ $task->category ? $task->category->getName(app()->getLocale()) : __('tasks.not_specified') }}</span>
                        <span class="ui-badge {{ $urgencyPill($task->urgency) }}">{{ $urgencyLabel($task->urgency) }}</span>
                        <span class="ui-badge border-white/20 bg-white/10 text-white">{{ $task->is_remote ? __('tasks.remote_work') : __('tasks.onsite_work') }}</span>
                    </div>
                    <h1 class="mt-3 text-2xl font-extrabold tracking-tight">{{ $task->getTitle() }}</h1>
                    <div class="mt-2 text-sm text-white/80">
                        <span>{{ $task->created_at->diffForHumans() }}</span>
                        @if($task->deadline)
                            <span class="mx-2">•</span>
                            <span>{{ $task->deadline->format('Y-m-d') }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col gap-2 lg:items-end">
                    <div class="ui-badge border-white/20 bg-white/10 text-white">
                        {{ number_format($task->budget_min) }} - {{ number_format($task->budget_max) }} {{ __('tasks.currency') }}
                    </div>
                    <div class="ui-badge border-white/20 bg-white/10 text-white">{{ $methodLabel }}</div>
                    <div class="ui-badge border-white/20 bg-white/10 text-white">
                        {{ $task->is_remote ? __('tasks.remote_work') : ($task->location ?? $task->city ?? __('tasks.location')) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="ui-card-body">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
                <div class="lg:col-span-8 space-y-6">
                    <section class="ui-card">
                        <div class="ui-card-body">
                            <h2 class="text-base font-extrabold tracking-tight">{{ __('tasks.description') }}</h2>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">{{ $task->getDescription() }}</p>

                            @if($task->required_skills && count($task->required_skills) > 0)
                                <div class="mt-5">
                                    <div class="text-sm font-extrabold tracking-tight">{{ __('tasks.required_skills') }}</div>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach($task->required_skills as $skill)
                                            <span class="ui-badge">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>

                    @if($task->images && count($task->images) > 0)
                        <section class="ui-card">
                            <div class="ui-card-body">
                                <h2 class="text-base font-extrabold tracking-tight">{{ __('tasks.attachments') }}</h2>
                                <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                    @foreach($task->images as $image)
                                        <a href="{{ asset('storage/' . $image) }}" class="block overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/30">
                                            <img src="{{ asset('storage/' . $image) }}" class="h-32 w-full object-cover" alt="{{ __('tasks.attached_images') }}">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif

                    @if($canApply)
                        <section class="ui-card">
                            <div class="ui-card-body">
                                <h2 class="text-base font-extrabold tracking-tight">{{ __('tasks.apply_for_task') }}</h2>
                                <form method="POST" action="{{ localized_route('tasks.apply', $task->id) }}" class="mt-4 space-y-4">
                                    @csrf
                                    <div>
                                        <label for="proposal" class="ui-label">{{ __('tasks.description') }}</label>
                                        <textarea name="proposal" id="proposal" rows="4" class="ui-input" placeholder="اشرح كيف ستقوم بتنفيذ هذه المهمة..." required></textarea>
                                    </div>
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div>
                                            <label for="proposed_budget" class="ui-label">{{ __('tasks.budget') }} ({{ __('tasks.currency') }})</label>
                                            <input type="number" name="proposed_budget" id="proposed_budget" class="ui-input" min="{{ $task->budget_min }}" max="{{ $task->budget_max }}" required>
                                            <div class="ui-muted mt-2">
                                                {{ number_format($task->budget_min) }} - {{ number_format($task->budget_max) }} {{ __('tasks.currency') }}
                                            </div>
                                        </div>
                                        <div>
                                            <label for="estimated_duration" class="ui-label">{{ __('tasks.estimated_duration') }}</label>
                                            <input type="number" name="estimated_duration" id="estimated_duration" class="ui-input" min="1" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="ui-btn ui-btn-primary">
                                        {{ __('ui.submit') }}
                                    </button>
                                </form>
                            </div>
                        </section>
                    @elseif(auth()->check() && auth()->user()->role === 'tasker')
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 text-sm text-slate-700 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-200">
                            @if($task->applications()->where('tasker_id', auth()->id())->exists())
                                لقد قدمت بالفعل على هذه المهمة.
                            @else
                                هذه المهمة غير متاحة للتقديم حالياً.
                            @endif
                        </div>
                    @elseif(!auth()->check())
                        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-900 dark:border-amber-900/40 dark:bg-amber-900/30 dark:text-amber-100">
                            <a class="font-extrabold underline" href="{{ localized_route('login') }}">سجل الدخول</a> للتقديم على هذه المهمة.
                        </div>
                    @endif
                </div>

                <aside class="lg:col-span-4 space-y-4">
                    @if(auth()->check() && auth()->user()->role === 'tasker' && $task->assigned_tasker_id === auth()->id() && in_array($task->status, ['assigned', 'in_progress']) && is_null($task->completion_requested_at))
                        <div class="ui-card">
                            <div class="ui-card-body">
                                <div class="text-sm font-extrabold tracking-tight">{{ __('Submit Completion') }}</div>
                                <form method="POST" action="{{ localized_route('tasks.submitCompletion', $task->id) }}" class="mt-4">
                                    @csrf
                                    <button type="submit" class="ui-btn ui-btn-primary w-full">{{ __('Mark as Done') }}</button>
                                </form>
                                <div class="ui-muted mt-2">{{ __('Client will review and approve.') }}</div>
                            </div>
                        </div>
                    @endif

                    @if(auth()->check() && auth()->user()->role === 'client' && auth()->id() === $task->client_id && !is_null($task->completion_requested_at))
                        <div class="ui-card">
                            <div class="ui-card-body">
                                <div class="text-sm font-extrabold tracking-tight">{{ __('Completion Approval') }}</div>
                                <div class="mt-4 flex gap-2">
                                    <form method="POST" action="{{ localized_route('tasks.approveCompletion', $task->id) }}" class="flex-1">
                                        @csrf
                                        <button type="submit" class="ui-btn ui-btn-primary w-full">{{ __('Approve') }}</button>
                                    </form>
                                    <form method="POST" action="{{ localized_route('tasks.declineCompletion', $task->id) }}" class="flex-1">
                                        @csrf
                                        <button type="submit" class="ui-btn ui-btn-secondary w-full">{{ __('Decline') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    @php
                        $canReview = auth()->check()
                            && auth()->user()->role === 'client'
                            && auth()->id() === $task->client_id
                            && $task->status === 'completed'
                            && $task->assigned_tasker_id
                            && $task->assignedTasker
                            && !$task->assignedTasker?->hasReviewFromClient(auth()->id(), $task->id);
                    @endphp
                    @if($canReview)
                        <div class="ui-card">
                            <div class="ui-card-body">
                                <div class="text-sm font-extrabold tracking-tight">{{ __('Leave a Review') }}</div>
                                <div class="ui-muted mt-2">{{ __('Share your experience with the tasker:') }} {{ $task->assignedTasker?->name }}</div>
                                <a href="{{ localized_route('reviews.create', ['tasker' => $task->assigned_tasker_id, 'task' => $task->id]) }}" class="ui-btn ui-btn-primary mt-4 w-full">
                                    {{ __('Review Tasker') }}
                                </a>
                            </div>
                        </div>
                    @endif

                    @if(auth()->check() && auth()->user()->role === 'client' && auth()->id() === $task->client_id)
                        <div class="ui-card">
                            <div class="ui-card-body">
                                <div class="text-sm font-extrabold tracking-tight">{{ __('Applications') }}</div>
                                <div class="mt-4 space-y-3">
                                    @forelse($task->applications as $application)
                                        <div class="rounded-2xl border border-slate-200 bg-white p-4 text-sm dark:border-slate-800 dark:bg-slate-950">
                                            <div class="flex items-start justify-between gap-3">
                                                <div class="min-w-0">
                                                    <div class="font-extrabold">{{ $application->user?->name ?? __('Unknown') }}</div>
                                                    <div class="ui-muted mt-1">{{ __('Budget') }}: {{ number_format($application->proposed_budget) }} {{ __('tasks.currency') }}</div>
                                                    <div class="ui-muted">{{ __('Duration') }}: {{ $application->estimated_duration }}</div>
                                                    <div class="mt-2 text-slate-700 dark:text-slate-200">{{ \Illuminate\Support\Str::limit($application->proposal, 140) }}</div>
                                                </div>
                                                <span class="ui-badge">{{ $application->status }}</span>
                                            </div>
                                            @if($task->status === 'open' && $application->status === 'pending')
                                                <div class="mt-3 flex gap-2">
                                                    <form method="POST" action="{{ localized_route('applications.accept', $application->id) }}" class="flex-1">
                                                        @csrf
                                                        <button type="submit" class="ui-btn ui-btn-primary w-full">{{ __('Accept') }}</button>
                                                    </form>
                                                    <form method="POST" action="{{ localized_route('applications.reject', $application->id) }}" class="flex-1">
                                                        @csrf
                                                        <button type="submit" class="ui-btn ui-btn-secondary w-full">{{ __('Reject') }}</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="ui-muted">{{ __('No applications yet') }}</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="ui-card">
                        <div class="ui-card-body space-y-3">
                            <div class="text-sm font-extrabold tracking-tight">{{ __('tasks.task_details') }}</div>
                            <div class="flex items-center justify-between gap-3 text-sm">
                                <div class="ui-muted">{{ __('tasks.budget') }}</div>
                                <div class="font-extrabold">{{ number_format($task->budget_min) }} - {{ number_format($task->budget_max) }} {{ __('tasks.currency') }}</div>
                            </div>
                            <div class="flex items-center justify-between gap-3 text-sm">
                                <div class="ui-muted">{{ __('tasks.payment_method') }}</div>
                                <div class="font-extrabold">{{ $methodLabel }}</div>
                            </div>
                            <div class="flex items-center justify-between gap-3 text-sm">
                                <div class="ui-muted">{{ __('tasks.location') }}</div>
                                <div class="font-extrabold">{{ $task->is_remote ? __('tasks.remote_work') : ($task->location ?? $task->city ?? '—') }}</div>
                            </div>
                            @if($task->deadline)
                                <div class="flex items-center justify-between gap-3 text-sm">
                                    <div class="ui-muted">{{ __('tasks.deadline') }}</div>
                                    <div class="font-extrabold">{{ $task->deadline->format('Y-m-d') }}</div>
                                </div>
                            @endif
                            <div class="flex items-center justify-between gap-3 text-sm">
                                <div class="ui-muted">{{ __('tasks.applications') }}</div>
                                <div class="font-extrabold">{{ $task->applications_count }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="ui-card">
                        <div class="ui-card-body">
                            <div class="text-sm font-extrabold tracking-tight">{{ __('tasks.client') }}</div>
                            <div class="mt-4 flex items-center gap-3">
                                <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900">
                                    {{ strtoupper(substr($task->client->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="truncate text-sm font-extrabold">{{ $task->client->name ?? '—' }}</div>
                                    <div class="ui-muted">{{ __('ui.member_since') }} {{ $task->client?->created_at?->format('Y') }}</div>
                                </div>
                            </div>
                            @if($task->client)
                                <div class="mt-4 grid grid-cols-2 gap-3">
                                    <div class="rounded-2xl border border-slate-200 bg-white p-3 text-sm dark:border-slate-800 dark:bg-slate-950">
                                        <div class="ui-muted">{{ __('ui.tasks') }}</div>
                                        <div class="mt-1 font-extrabold">{{ $task->client->tasks()->count() }}</div>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 bg-white p-3 text-sm dark:border-slate-800 dark:bg-slate-950">
                                        <div class="ui-muted">{{ __('tasks.completed_tasks') ?? 'Completed' }}</div>
                                        <div class="mt-1 font-extrabold">{{ $task->client->tasks()->where('status', 'completed')->count() }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
