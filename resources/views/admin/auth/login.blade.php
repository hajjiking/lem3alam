<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - {{ __('ui.app_name') }}</title>

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
                    <div class="flex items-center gap-3">
                        <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900">A</div>
                        <div>
                            <div class="text-base font-extrabold tracking-tight">{{ __('ui.app_name') }} Admin</div>
                            <div class="ui-muted">Sign in to your admin account</div>
                        </div>
                    </div>
                </div>

                <div class="ui-card-body">
                    @if (session('success'))
                        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-100">
                            {{ session('success') }}
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

                    <form method="POST" action="{{ route('admin.authenticate') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="email" class="ui-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="ui-input">
                        </div>

                        <div>
                            <label for="password" class="ui-label">Password</label>
                            <input type="password" id="password" name="password" required autocomplete="current-password" class="ui-input">
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <label class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-900">
                                Remember me
                            </label>
                            <a href="{{ route('admin.password.request') }}" class="text-sm font-semibold text-slate-700 hover:text-slate-900 dark:text-slate-200 dark:hover:text-white">Forgot password?</a>
                        </div>

                        <button type="submit" class="ui-btn ui-btn-primary w-full">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
