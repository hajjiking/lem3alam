<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('ui.app_name'))</title>
    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @endif

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
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/70 backdrop-blur dark:border-slate-800/70 dark:bg-slate-950/70">
        <div class="ui-container">
            <div class="flex h-16 items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    @auth
                        <button type="button" class="ui-btn ui-btn-ghost hidden lg:inline-flex" data-sidebar-toggle aria-label="Toggle sidebar">
                            <span class="text-base">⟷</span>
                        </button>
                    @endauth
                    <a href="{{ localized_route('home') }}" class="inline-flex items-center gap-2 font-display text-lg font-extrabold tracking-tight">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm dark:bg-white dark:text-slate-900">
                            M
                        </span>
                        <span class="hidden sm:inline">{{ __('ui.app_name') }}</span>
                    </a>
                </div>

                <nav class="hidden items-center gap-1 lg:flex">
                    <a class="ui-btn ui-btn-ghost" href="{{ localized_route('home') }}">{{ __('ui.home') }}</a>
                    <a class="ui-btn ui-btn-ghost" href="{{ localized_route('tasks.index') }}">{{ __('ui.tasks') }}</a>
                    <a class="ui-btn ui-btn-ghost" href="{{ localized_route('categories.index') }}">{{ __('ui.categories') }}</a>
                    @auth
                        <a class="ui-btn ui-btn-ghost" href="{{ localized_route('tasks.my') }}">{{ __('ui.my_tasks') }}</a>
                    @endauth
                </nav>

                <div class="flex items-center gap-2">
                    <button type="button" class="ui-btn ui-btn-ghost" data-theme-toggle aria-pressed="false" aria-label="Toggle theme">
                        <span class="hidden dark:inline">☾</span>
                        <span class="dark:hidden">☀</span>
                    </button>

                    <div class="hidden sm:block">
                        <x-language-switcher />
                    </div>

                    @auth
                        <details class="relative">
                            <summary class="ui-btn ui-btn-secondary list-none">
                                <span class="max-w-[140px] truncate">{{ auth()->user()->name }}</span>
                                <span aria-hidden="true">▾</span>
                            </summary>
                            <div class="absolute end-0 mt-2 w-64 ui-card">
                                <div class="p-2">
                                    @php $role = auth()->user()->role; @endphp
                                    @if ($role === 'admin')
                                        <a class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-900" href="{{ route('admin.dashboard') }}">{{ __('ui.dashboard') }}</a>
                                    @elseif ($role === 'client')
                                        <a class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-900" href="{{ localized_route('dashboard.client') }}">{{ __('ui.dashboard') }}</a>
                                    @elseif ($role === 'tasker')
                                        <a class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-900" href="{{ localized_route('dashboard.tasker') }}">{{ __('ui.dashboard') }}</a>
                                        <a class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-900" href="{{ localized_route('tasker.profile.edit') }}">{{ __('ui.edit_profile_title') }}</a>
                                        <a class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-900" href="{{ localized_route('tasker.portfolio.index') }}">{{ __('ui.portfolio') }}</a>
                                        <a class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-900" href="{{ localized_route('tasker.profile.show', ['id' => auth()->id()]) }}">{{ __('ui.view') }} {{ __('ui.profile') }}</a>
                                    @endif
                                    <a class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-900" href="{{ localized_route('profile.edit') }}">{{ __('ui.profile') }}</a>
                                    <div class="my-2 h-px bg-slate-200/70 dark:bg-slate-800/70"></div>
                                    <form method="POST" action="{{ localized_route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-900">
                                            {{ __('auth.logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </details>
                    @else
                        <a href="{{ localized_route('login') }}" class="ui-btn ui-btn-secondary">{{ __('auth.login') }}</a>
                        <a href="{{ localized_route('register') }}" class="ui-btn ui-btn-primary">{{ __('auth.register') }}</a>
                    @endauth

                    <button type="button" class="ui-btn ui-btn-secondary lg:hidden" data-mobile-nav-toggle="mobileNav" aria-expanded="false" aria-controls="mobileNav">
                        ☰
                    </button>
                </div>
            </div>
        </div>

        <div id="mobileNav" class="hidden border-t border-slate-200/70 dark:border-slate-800/70 lg:hidden">
            <div class="ui-container py-3">
                <div class="flex flex-col gap-2">
                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ localized_route('home') }}">{{ __('ui.home') }}</a>
                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ localized_route('tasks.index') }}">{{ __('ui.tasks') }}</a>
                    <a class="ui-btn ui-btn-ghost justify-start" href="{{ localized_route('categories.index') }}">{{ __('ui.categories') }}</a>
                    @auth
                        <a class="ui-btn ui-btn-ghost justify-start" href="{{ localized_route('tasks.my') }}">{{ __('ui.my_tasks') }}</a>
                    @endauth
                    <div class="pt-2">
                        <x-language-switcher />
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="fixed inset-x-0 top-16 z-50 pointer-events-none">
        <div class="ui-container">
            <div class="flex justify-end pt-3">
                @if (session('success'))
                    <div id="toastSuccess" class="ui-toast">
                        <div class="ui-card-body flex items-start gap-3">
                            <div class="ui-badge border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-200">OK</div>
                            <div class="min-w-0">
                                <div class="text-sm font-semibold">{{ session('success') }}</div>
                                <div class="ui-muted">{{ __('ui.success') ?? 'Success' }}</div>
                            </div>
                            <button type="button" class="ui-btn ui-btn-ghost ms-auto" data-dismiss="#toastSuccess" aria-label="Dismiss">✕</button>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div id="toastError" class="ui-toast">
                        <div class="ui-card-body flex items-start gap-3">
                            <div class="ui-badge border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-200">ERR</div>
                            <div class="min-w-0">
                                <div class="text-sm font-semibold">{{ session('error') }}</div>
                                <div class="ui-muted">{{ __('ui.error') ?? 'Error' }}</div>
                            </div>
                            <button type="button" class="ui-btn ui-btn-ghost ms-auto" data-dismiss="#toastError" aria-label="Dismiss">✕</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <main class="py-8">
        <div class="ui-container">
            <div class="flex gap-6">
                @auth
                    <aside data-app-sidebar class="hidden lg:block w-64 shrink-0">
                        <div class="ui-card sticky top-24">
                            <div class="p-3">
                                @php $role = auth()->user()->role; @endphp
                                <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('dashboard.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ $role === 'tasker' ? localized_route('dashboard.tasker') : ($role === 'client' ? localized_route('dashboard.client') : localized_route('home')) }}">
                                    <span class="text-base"><i class="fa-solid fa-grid-2"></i></span>
                                    <span data-sidebar-label class="truncate">{{ __('ui.dashboard') }}</span>
                                </a>
                                <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('tasks.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ localized_route('tasks.my') }}">
                                    <span class="text-base"><i class="fa-regular fa-clipboard"></i></span>
                                    <span data-sidebar-label class="truncate">{{ __('ui.my_tasks') }}</span>
                                </a>
                                <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('messages.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ localized_route('messages.index') }}">
                                    <span class="text-base"><i class="fa-regular fa-message"></i></span>
                                    <span data-sidebar-label class="truncate">{{ __('ui.messages') ?? 'Messages' }}</span>
                                </a>
                                <div class="my-3 ui-divider"></div>
                                <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('profile.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ localized_route('profile.edit') }}">
                                    <span class="text-base"><i class="fa-regular fa-user"></i></span>
                                    <span data-sidebar-label class="truncate">{{ __('ui.profile') }}</span>
                                </a>
                                @if ($role === 'tasker')
                                    <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('tasker.profile.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ localized_route('tasker.profile.edit') }}">
                                        <span class="text-base"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
                                        <span data-sidebar-label class="truncate">{{ __('ui.edit_profile_title') }}</span>
                                    </a>
                                    <a class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition hover:bg-slate-50 dark:hover:bg-slate-900 {{ request()->routeIs('tasker.portfolio.*') ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-700 dark:text-slate-200' }}" href="{{ localized_route('tasker.portfolio.index') }}">
                                        <span class="text-base"><i class="fa-regular fa-images"></i></span>
                                        <span data-sidebar-label class="truncate">{{ __('ui.portfolio') }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </aside>
                @endauth

                <div class="min-w-0 flex-1">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200/70 py-10 dark:border-slate-800/70">
        <div class="ui-container">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="ui-muted">© {{ date('Y') }} {{ __('ui.app_name') }}</div>
                <div class="flex flex-wrap gap-2">
                    <a class="ui-btn ui-btn-ghost" href="{{ localized_route('how-it-works') }}">{{ __('ui.how_it_works') }}</a>
                    <a class="ui-btn ui-btn-ghost" href="{{ localized_route('pricing') }}">{{ __('ui.pricing') }}</a>
                    <a class="ui-btn ui-btn-ghost" href="{{ localized_route('privacy') }}">{{ __('ui.privacy') }}</a>
                    <a class="ui-btn ui-btn-ghost" href="{{ localized_route('terms') }}">{{ __('ui.terms') }}</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
