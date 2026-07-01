@extends('layouts.app')

@section('title', __('ui.messages'))

@section('content')
@php
    $user = auth()->user();
@endphp

<div class="ui-fade-in max-w-4xl">
    <div class="mb-6 flex items-center justify-between gap-3">
        <h1 class="text-2xl font-extrabold tracking-tight">{{ __('ui.messages') }}</h1>
        <a href="{{ localized_route('tasks.my') }}" class="ui-btn ui-btn-secondary">
            <i class="fa-regular fa-clipboard"></i>
            <span class="truncate">{{ __('ui.my_tasks') }}</span>
        </a>
    </div>

    <div class="ui-card">
        <div class="ui-card-body p-3">
            <div class="grid gap-2">
                @forelse($conversations as $participantId => $messages)
                    @php
                        $last = $messages->sortByDesc('created_at')->first();
                        $participantName = $last->sender_id === $user->id ? $last->receiver->name : $last->sender->name;
                        $unread = $messages->where('receiver_id', $user->id)->where('is_read', false)->count();
                    @endphp
                    <a href="{{ localized_route('messages.show', $participantId) }}" class="group rounded-2xl border border-slate-200/60 bg-white/50 p-4 transition hover:bg-white/80 hover:shadow-sm dark:border-slate-800/60 dark:bg-slate-950/40 dark:hover:bg-slate-950/60">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm dark:bg-white dark:text-slate-900">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="truncate text-sm font-extrabold text-slate-900 dark:text-white">{{ $participantName }}</div>
                                        <div class="mt-1 truncate text-sm text-slate-600 dark:text-slate-300">{{ $last->content }}</div>
                                    </div>
                                    <div class="shrink-0 text-end">
                                        <div class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ $last->created_at->diffForHumans() }}</div>
                                        @if($unread > 0)
                                            <div class="mt-1 inline-flex items-center rounded-full bg-rose-600 px-2 py-0.5 text-xs font-extrabold text-white" data-sidebar-badge>{{ $unread }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="ui-empty">
                        <div class="ui-empty-body">
                            <div class="ui-badge"><i class="fa-regular fa-message"></i></div>
                            <div class="text-sm font-extrabold text-slate-900 dark:text-white">{{ __('ui.no_messages') }}</div>
                            <div class="ui-muted">{{ __('ui.no_messages_hint') }}</div>
                            <a href="{{ localized_route('tasks.index') }}" class="ui-btn ui-btn-primary">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span class="truncate">{{ __('ui.tasks') }}</span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
