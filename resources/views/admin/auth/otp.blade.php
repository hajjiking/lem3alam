<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin OTP - {{ __('ui.app_name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&family=Cairo:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        (() => {
            try {
                const t = localStorage.getItem('theme');
                const prefers = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                const useDark = t ? t === 'dark' : prefers;
                document.documentElement.classList.toggle('dark', useDark);
                document.documentElement.dataset.theme = useDark ? 'dark' : 'light';
            } catch (_) {}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    <main class="ui-container flex min-h-dvh items-center justify-center py-12">
        <div class="w-full max-w-md">
            <div class="ui-card overflow-hidden">
                <div class="border-b border-slate-200/70 bg-gradient-to-br from-white to-slate-50 px-6 py-5 dark:border-slate-800/70 dark:from-slate-950 dark:to-slate-900/40">
                    <h1 class="text-xl font-extrabold tracking-tight">Two-Factor Verification</h1>
                    <p class="ui-muted mt-1">Enter the 6-digit code sent to your email</p>
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
                    @if (session('status'))
                        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-100">
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="mb-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900 dark:border-amber-900/40 dark:bg-amber-900/30 dark:text-amber-100">
                            <p>{{ session('warning') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.otp.verify') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="otp" class="ui-label">Verification Code</label>
                            <input type="text" id="otp" name="otp" maxlength="6" minlength="6" pattern="[0-9]{6}" required inputmode="numeric"
                                   class="ui-input text-center tracking-[0.35em] text-lg font-extrabold">
                        </div>

                        <button type="submit" class="ui-btn ui-btn-primary w-full">Verify</button>
                    </form>

                    <form method="POST" action="{{ route('admin.otp.resend') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="ui-btn ui-btn-secondary w-full">Resend code</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
