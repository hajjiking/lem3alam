<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - {{ __('ui.app_name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&family=Cairo:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    @php($adminUser = auth('admin')->user())
    <div class="min-h-dvh">
        <div class="flex">
            <aside data-app-sidebar class="hidden h-dvh w-72 shrink-0 border-e border-slate-200/70 bg-white/70 backdrop-blur dark:border-slate-800/70 dark:bg-slate-950/60 lg:block">
                <div class="flex h-16 items-center gap-2 px-4">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 font-display text-base font-extrabold tracking-tight">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm dark:bg-white dark:text-slate-900">A</span>
                        <span data-sidebar-label class="truncate">{{ __('ui.app_name') }} Admin</span>
                    </a>
                    <button type="button" class="ui-btn ui-btn-ghost ms-auto" data-sidebar-toggle aria-label="Collapse sidebar">⟷</button>
                </div>

                <nav class="px-3 py-4">
                    @if($adminUser?->can('view_analytics'))
                        <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ route('admin.dashboard') }}">
                            <span class="text-base">⌂</span>
                            <span data-sidebar-label class="truncate">Dashboard</span>
                        </a>
                    @endif
                    @if($adminUser?->can('manage_users'))
                        <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('admin.users.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ route('admin.users.index') }}">
                            <span class="text-base">👤</span>
                            <span data-sidebar-label class="truncate">Users</span>
                        </a>
                    @endif
                    @if($adminUser?->can('manage_tasks'))
                        <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('admin.tasks.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ route('admin.tasks.index') }}">
                            <span class="text-base">✓</span>
                            <span data-sidebar-label class="truncate">Tasks</span>
                        </a>
                    @endif
                    @if($adminUser?->can('manage_categories'))
                        <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('admin.categories.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ route('admin.categories.index') }}">
                            <span class="text-base">#</span>
                            <span data-sidebar-label class="truncate">Categories</span>
                        </a>
                    @endif
                    @if($adminUser?->can('manage_payments'))
                        <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('admin.payments.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ route('admin.payments.index') }}">
                            <span class="text-base">💳</span>
                            <span data-sidebar-label class="truncate">Payments</span>
                        </a>
                    @endif
                    @if($adminUser?->can('manage_disputes'))
                        <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('admin.disputes.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ route('admin.disputes.index') }}">
                            <span class="text-base">⚠</span>
                            <span data-sidebar-label class="truncate">Disputes</span>
                        </a>
                    @endif
                    @if($adminUser?->can('view_analytics'))
                        <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('admin.reports') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ route('admin.reports') }}">
                            <span class="text-base">▦</span>
                            <span data-sidebar-label class="truncate">Reports</span>
                        </a>
                    @endif
                    @if($adminUser?->can('view_audit_logs'))
                        <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('admin.audit-logs.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ route('admin.audit-logs.index') }}">
                            <span class="text-base">⎘</span>
                            <span data-sidebar-label class="truncate">Audit Logs</span>
                        </a>
                    @endif
                </nav>
            </aside>

            <div class="min-w-0 flex-1">
                <header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/70 backdrop-blur dark:border-slate-800/70 dark:bg-slate-950/70">
                    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-3 px-4">
                        <div class="flex items-center gap-2">
                            <button type="button" class="ui-btn ui-btn-secondary lg:hidden" data-mobile-nav-toggle="adminMobileNav" aria-expanded="false" aria-controls="adminMobileNav">☰</button>
                            <div class="text-sm font-semibold text-slate-600 dark:text-slate-300">@yield('page-title', 'Dashboard')</div>
                        </div>

                        <div class="flex items-center gap-2" x-data="{ notificationsOpen: false, profileOpen: false }">
                            @php($searchAction = $adminUser?->can('manage_users') ? route('admin.users.index') : ($adminUser?->can('manage_tasks') ? route('admin.tasks.index') : null))
                            @if($searchAction)
                                <form method="GET" action="{{ $searchAction }}" class="hidden items-center gap-2 sm:flex">
                                    <div class="relative">
                                        <input name="q" value="{{ request('q') }}" placeholder="Search…" class="ui-input h-9 w-72 ps-9">
                                        <span class="pointer-events-none absolute inset-y-0 start-3 inline-flex items-center text-slate-400">⌕</span>
                                    </div>
                                </form>
                            @endif

                            <button type="button" class="ui-btn ui-btn-ghost" data-theme-toggle aria-pressed="false" aria-label="Toggle theme">
                                <span class="hidden dark:inline">☾</span>
                                <span class="dark:hidden">☀</span>
                            </button>

                            <div class="relative">
                                <button type="button" class="ui-btn ui-btn-ghost" @click="notificationsOpen = !notificationsOpen" :aria-expanded="notificationsOpen ? 'true' : 'false'" aria-haspopup="menu" aria-label="Notifications">🔔</button>
                                <div x-cloak x-show="notificationsOpen" @click.outside="notificationsOpen = false" class="absolute end-0 mt-2 w-80 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg dark:border-slate-800 dark:bg-slate-950">
                                    <div class="border-b border-slate-200/70 px-4 py-3 text-sm font-extrabold dark:border-slate-800/70">Notifications</div>
                                    <div class="px-4 py-6 text-center text-sm text-slate-500 dark:text-slate-400">No notifications yet.</div>
                                </div>
                            </div>

                            <div class="relative">
                                <button type="button" class="ui-btn ui-btn-secondary" @click="profileOpen = !profileOpen" :aria-expanded="profileOpen ? 'true' : 'false'" aria-haspopup="menu">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-slate-900 text-xs font-extrabold text-white dark:bg-white dark:text-slate-900">{{ mb_strtoupper(mb_substr($adminUser?->name ?? 'A', 0, 1)) }}</span>
                                    <span class="hidden sm:inline">{{ $adminUser?->name ?? 'Admin' }}</span>
                                </button>
                                <div x-cloak x-show="profileOpen" @click.outside="profileOpen = false" class="absolute end-0 mt-2 w-72 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg dark:border-slate-800 dark:bg-slate-950">
                                    <div class="border-b border-slate-200/70 px-4 py-3 dark:border-slate-800/70">
                                        <div class="text-sm font-extrabold">{{ $adminUser?->name ?? 'Admin' }}</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $adminUser?->email ?? '' }}</div>
                                    </div>
                                    <div class="p-2">
                                        @if($adminUser?->can('view_audit_logs'))
                                            <a class="ui-btn ui-btn-ghost w-full justify-start" href="{{ route('admin.audit-logs.index') }}">Audit Logs</a>
                                        @endif
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <button type="submit" class="ui-btn ui-btn-secondary w-full justify-start">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="adminMobileNav" class="hidden border-t border-slate-200/70 dark:border-slate-800/70 lg:hidden">
                        <div class="px-4 py-3">
                            <div class="grid gap-2">
                                @if($adminUser?->can('view_analytics'))
                                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                @endif
                                @if($adminUser?->can('manage_users'))
                                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ route('admin.users.index') }}">Users</a>
                                @endif
                                @if($adminUser?->can('manage_tasks'))
                                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ route('admin.tasks.index') }}">Tasks</a>
                                @endif
                                @if($adminUser?->can('manage_categories'))
                                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ route('admin.categories.index') }}">Categories</a>
                                @endif
                                @if($adminUser?->can('manage_payments'))
                                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ route('admin.payments.index') }}">Payments</a>
                                @endif
                                @if($adminUser?->can('manage_disputes'))
                                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ route('admin.disputes.index') }}">Disputes</a>
                                @endif
                                @if($adminUser?->can('view_analytics'))
                                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ route('admin.reports') }}">Reports</a>
                                @endif
                                @if($adminUser?->can('view_audit_logs'))
                                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ route('admin.audit-logs.index') }}">Audit Logs</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </header>

                <main class="mx-auto w-full max-w-7xl px-4 py-8">
                    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <h1 class="text-xl font-extrabold tracking-tight">@yield('page-title', 'Dashboard')</h1>
                        <div class="flex flex-wrap gap-2">@yield('page-actions')</div>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 ui-card">
                            <div class="ui-card-body flex items-start gap-3">
                                <div class="ui-badge border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-200">OK</div>
                                <div class="min-w-0 text-sm font-semibold">{{ session('success') }}</div>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 ui-card">
                            <div class="ui-card-body flex items-start gap-3">
                                <div class="ui-badge border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-200">ERR</div>
                                <div class="min-w-0 text-sm font-semibold">{{ session('error') }}</div>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
