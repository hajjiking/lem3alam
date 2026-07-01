@extends('layouts.app')

@section('title', 'إعادة تعيين كلمة المرور')

@section('content')
<div class="mx-auto w-full max-w-md">
    <div class="ui-card overflow-hidden">
        <div class="border-b border-slate-200/70 bg-gradient-to-br from-white to-slate-50 px-6 py-5 dark:border-slate-800/70 dark:from-slate-950 dark:to-slate-900/40">
            <h1 class="text-xl font-extrabold tracking-tight">إعادة تعيين كلمة المرور</h1>
            <p class="ui-muted mt-1">قم بتعيين كلمة مرور جديدة لحسابك.</p>
        </div>

        <div class="ui-card-body">
            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-100">
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ localized_route('password.update') }}" class="space-y-4">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="ui-label">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email" value="{{ $email ?? old('email') }}" required readonly class="ui-input opacity-80">
                    @error('email')
                        <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password" class="ui-label">كلمة المرور الجديدة</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="ui-input">
                    @error('password')
                        <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="ui-label">تأكيد كلمة المرور الجديدة</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="ui-input">
                </div>

                <button type="submit" class="ui-btn ui-btn-primary w-full">
                    إعادة تعيين كلمة المرور
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
