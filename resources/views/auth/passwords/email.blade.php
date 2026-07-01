@extends('layouts.app')

@section('title', 'إعادة تعيين كلمة المرور')

@section('content')
<div class="mx-auto w-full max-w-md">
    <div class="ui-card overflow-hidden">
        <div class="border-b border-slate-200/70 bg-gradient-to-br from-white to-slate-50 px-6 py-5 dark:border-slate-800/70 dark:from-slate-950 dark:to-slate-900/40">
            <h1 class="text-xl font-extrabold tracking-tight">إعادة تعيين كلمة المرور</h1>
            <p class="ui-muted mt-1">أدخل بريدك الإلكتروني وسنرسل لك رابط إعادة التعيين.</p>
        </div>

        <div class="ui-card-body">
            @if (session('status'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-100" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-100">
                    <ul class="list-disc space-y-1 ps-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ localized_route('password.email') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="ui-label">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="ui-input">
                    @error('email')
                        <div class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="ui-btn ui-btn-primary w-full">
                    إرسال رابط إعادة التعيين
                </button>

                <div class="pt-2 text-center">
                    <a href="{{ localized_route('login') }}" class="text-sm font-semibold text-slate-700 underline decoration-slate-300 underline-offset-4 hover:text-slate-900 dark:text-slate-200 dark:decoration-slate-700 dark:hover:text-white">
                        العودة لتسجيل الدخول
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
