@extends('layouts.app')

@section('title', __('ui.messages'))

@section('content')
<div class="ui-fade-in max-w-4xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
            <h1 class="truncate text-2xl font-extrabold tracking-tight">{{ $otherUser->name }}</h1>
            <div class="ui-muted mt-1">{{ __('ui.messages') }}</div>
        </div>
        <a href="{{ localized_route('messages.index') }}" class="ui-btn ui-btn-secondary">
            <i class="fa-solid fa-arrow-left rtl:rotate-180"></i>
            <span class="truncate">{{ __('ui.back') }}</span>
        </a>
    </div>

    <div class="ui-card">
        <div class="ui-card-body flex min-h-[320px] flex-col gap-3">
            @foreach($messages as $message)
                @php($mine = $message->sender_id === auth()->id())
                <div class="flex {{ $mine ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $mine ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'bg-slate-100 text-slate-900 dark:bg-slate-900/50 dark:text-slate-100' }} max-w-[80%] rounded-2xl px-4 py-3 shadow-sm">
                        <div class="whitespace-pre-line text-sm font-medium leading-relaxed">{{ $message->content }}</div>
                        <div class="{{ $mine ? 'text-white/70 dark:text-slate-600' : 'text-slate-500 dark:text-slate-400' }} mt-2 text-xs font-semibold">
                            {{ $message->created_at->translatedFormat('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="border-t border-slate-200/70 p-4 dark:border-slate-800/70">
            <form method="POST" action="{{ localized_route('messages.reply', $otherUser->id) }}" enctype="multipart/form-data" class="grid gap-3 sm:grid-cols-[1fr_auto] sm:items-end">
                @csrf
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="content" class="ui-label">{{ __('ui.type_message') ?? 'Message' }}</label>
                        <input id="content" type="text" name="content" class="ui-input" placeholder="{{ __('ui.type_message') ?? 'Type a message…' }}" required maxlength="1000">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="attachment" class="ui-label">{{ __('ui.attachment') ?? 'Attachment' }}</label>
                        <input id="attachment" type="file" name="attachment" class="ui-input" accept="image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                </div>
                <button type="submit" class="ui-btn ui-btn-primary sm:self-end">
                    <i class="fa-regular fa-paper-plane"></i>
                    <span class="truncate">{{ __('ui.send') ?? 'Send' }}</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
