<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('ui.app_name') }}</title>
    
    <!-- Bootstrap CSS -->
    @if(app()->getLocale() === 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if(app()->getLocale() === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @endif
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom CSS -->
    <style>
        /* Define CSS Variables First */
        :root {
            --primary-50: #eff6ff;
            --primary-100: #dbeafe;
            --primary-200: #bfdbfe;
            --primary-300: #93c5fd;
            --primary-400: #60a5fa;
            --primary-500: #3b82f6;
            --primary-600: #2563eb;
            --primary-700: #1d4ed8;
            --primary-800: #1e40af;
            --primary-900: #1e3a8a;
            
            --neutral-50: #fafafa;
            --neutral-100: #f5f5f5;
            --neutral-200: #e5e5e5;
            --neutral-300: #d4d4d4;
            --neutral-400: #a3a3a3;
            --neutral-500: #737373;
            --neutral-600: #525252;
            --neutral-700: #404040;
            --neutral-800: #262626;
            --neutral-900: #171717;
            --primary-500-rgb: 59, 130, 246;
            --neutral-300-rgb: 212, 212, 212;
            --accent-50: #fff5f5;
            --accent-100: #fee2e2;
            --accent-200: #fecaca;
            --accent-300: #fca5a5;
            --accent-400: #f87171;
            --accent-500: #e53935;
            --accent-600: #c1272d;
            --accent-700: #a31f24;
            --accent-800: #8a1a1f;
            --accent-900: #6e161a;
            --accent-500-rgb: 229, 57, 53;
            --secondary-50: #eef8f3;
            --secondary-100: #d9f1e5;
            --secondary-200: #bce4d0;
            --secondary-300: #90d2b3;
            --secondary-400: #61be95;
            --secondary-500: #2fae76;
            --secondary-600: #22895d;
            --secondary-700: #196a47;
            --secondary-800: #124e35;
            --secondary-900: #0b3725;
            --success-50: #ecfdf5;
            --success-100: #d1fae5;
            --success-200: #a7f3d0;
            --success-300: #6ee7b7;
            --success-400: #34d399;
            --success-500: #10b981;
            --success-600: #059669;
            --success-700: #047857;
            --success-800: #065f46;
            --success-900: #064e3b;
            --warning-50: #fffbeb;
            --warning-100: #fef3c7;
            --warning-200: #fde68a;
            --warning-300: #fcd34d;
            --warning-400: #fbbf24;
            --warning-500: #f59e0b;
            --warning-600: #d97706;
            --warning-700: #b45309;
            --warning-800: #92400e;
            --warning-900: #78350f;
            --error-50: #fef2f2;
            --error-100: #fee2e2;
            --error-200: #fecaca;
            --error-300: #fca5a5;
            --error-400: #f87171;
            --error-500: #ef4444;
            --error-600: #dc2626;
            --error-700: #b91c1c;
            --error-800: #991b1b;
            --error-900: #7f1d1d;
            --transition-base: 0.2s ease;
            
            --neutral-25: #fdfdfd;
            --primary-25: #f6faff;
            --accent-25: #fff7f7;
            --secondary-25: #f3fbf6;
            
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }
        
        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            direction: ltr;
            background-color: #ffffff;
            color: var(--neutral-800);
            line-height: 1.6;
            padding-top: 100px;
        }

        html[dir="rtl"] body {
            font-family: 'Cairo', 'Tajawal', 'Amiri', sans-serif;
            direction: rtl;
            line-height: 1.8;
            letter-spacing: 0.02em;
        }
        
        /* Container adjustments for RTL */
        .navbar .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding-right: 15px !important;
            padding-left: 15px !important;
        }
        
        .navbar-brand {
            background: linear-gradient(135deg, var(--primary-600), var(--accent-600));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5rem;
            font-family: 'Poppins', 'Inter', sans-serif;
            visibility: visible !important;
            opacity: 1 !important;
            margin-bottom: 0;
            order: 1;
            margin-right: auto;
            margin-left: 0;
        }

        html[dir="rtl"] .navbar-brand {
            font-family: 'Cairo', 'Amiri', serif;
        }
        
        html[dir="rtl"] .text-start { text-align: right !important; }
        html[dir="rtl"] .text-end { text-align: left !important; }
        html[dir="rtl"] .me-auto { margin-left: auto !important; margin-right: 0 !important; }
        html[dir="rtl"] .ms-auto { margin-right: auto !important; margin-left: 0 !important; }
        
        /* Navbar specific RTL adjustments */
        html[dir="rtl"] .nav-link {
            padding-right: 1rem !important;
            padding-left: 0.5rem !important;
        }
        
        html[dir="rtl"] .nav-link i {
            margin-left: 0.5rem !important;
            margin-right: 0 !important;
        }
        
        /* Language switcher positioning for RTL */
        html[dir="rtl"] .language-switcher {
            margin-left: 1rem;
            margin-right: 0;
        }
        
        /* Dropdown menu RTL adjustments */
        html[dir="rtl"] .dropdown-menu {
            right: 0;
            left: auto;
            text-align: right;
        }
        
        html[dir="rtl"] .dropdown-item {
            text-align: right;
            padding-right: 1rem;
            padding-left: 0.5rem;
        }
        
        html[dir="rtl"] .dropdown-item i {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        
        /* Modern navbar with enhanced styling */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid var(--neutral-200);
            box-shadow: var(--shadow-lg);
            padding: 1rem 0;
            min-height: 80px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            transition: all var(--transition-base);
        }
        
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-xl);
            padding: 0.75rem 0;
            min-height: 70px;
        }

        .hero-modern::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(var(--accent-500-rgb), 0.08) 0, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(47, 174, 118, 0.12) 0, transparent 45%),
                repeating-linear-gradient(45deg, rgba(255,255,255,0.06) 0, rgba(255,255,255,0.06) 2px, transparent 2px, transparent 10px);
            opacity: 0.25;
            mix-blend-mode: overlay;
            z-index: 1;
        }

        /* Hero CTA alignment and consistency */
        .hero-cta-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }
        @media (min-width: 992px) {
            [dir="ltr"] .hero-cta-container { justify-content: flex-start; }
            [dir="rtl"] .hero-cta-container { justify-content: flex-end; }
        }
        .hero-cta-container .btn-hero-primary,
        .hero-cta-container .btn-hero-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            min-height: 56px;
            padding: 1rem 2.5rem;
            line-height: 1;
            border-radius: 50px;
            font-size: 1.1rem;
            margin: 0;
        }
        .hero-cta-container .btn-content {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .hero-cta-container .btn-content i { font-size: 1.2rem; }
        /* Flex gap fallback for older browsers */
        @supports not (gap: 1rem) {
            .hero-cta-container > a { margin: 0 0.5rem 0.5rem 0; }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .nav-link:hover,
            .dropdown-item:hover,
            .navbar-brand:hover {
                transform: none !important;
                box-shadow: none !important;
                filter: none !important;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .navbar-collapse {
                transition: none;
            }
            .m3-hamburger span {
                transition: none;
            }
        }
        
        .navbar-brand {
            background: linear-gradient(135deg, var(--primary-600), var(--accent-600), var(--primary-700));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 1.75rem;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            visibility: visible !important;
            opacity: 1 !important;
            transition: all var(--transition-base);
            position: relative;
        }

        html[dir="rtl"] .navbar-brand {
            font-family: 'Cairo', 'Noto Sans Arabic', sans-serif;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
            filter: brightness(1.1);
        }
        
        .navbar-brand i {
            background: linear-gradient(135deg, var(--primary-600), var(--accent-600));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }


        

        
        .nav-link {
            color: var(--neutral-700) !important;
            font-weight: 600;
            transition: all var(--transition-base);
            padding: 0.75rem 1.25rem !important;
            border-radius: var(--radius-lg);
            position: relative;
            visibility: visible !important;
            opacity: 1 !important;
            white-space: nowrap;
            text-decoration: none;
            border: 2px solid transparent;
            background: transparent;
        }
        
        .nav-link:hover {
            color: var(--primary-600) !important;
            background: linear-gradient(135deg, var(--primary-50), var(--accent-50));
            border-color: var(--primary-200);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        .nav-link.active {
            color: var(--primary-700) !important;
            background: linear-gradient(135deg, var(--primary-100), var(--accent-100));
            border-color: var(--primary-300);
            box-shadow: var(--shadow-sm);
        }
        
        .nav-link i {
            margin-right: 0.5rem;
            font-size: 0.9rem;
            opacity: 0.8;
            transition: all var(--transition-base);
        }
        
        .nav-link:hover i {
            opacity: 1;
            transform: scale(1.1);
        }
        
        /* Enhanced dropdown styling */
        .dropdown-menu {
            border: 1px solid var(--neutral-200) !important;
            box-shadow: var(--shadow-xl);
            border-radius: var(--radius-xl);
            padding: 1rem;
            margin-top: 0.75rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            visibility: visible !important;
            opacity: 1 !important;
            min-width: 220px;
            animation: dropdownFadeIn 0.2s ease-out;
        }
        
        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .dropdown-item {
            border-radius: var(--radius-lg);
            padding: 0.75rem 1rem;
            transition: all var(--transition-base);
            color: var(--neutral-700);
            visibility: visible !important;
            opacity: 1 !important;
            font-weight: 500;
            border: 2px solid transparent;
            margin-bottom: 0.25rem;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--primary-50), var(--accent-50)) !important;
            color: var(--primary-700) !important;
            border-color: var(--primary-200);
            transform: translateX(4px);
            box-shadow: var(--shadow-sm);
        }
        
        .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
            opacity: 0.7;
            transition: all var(--transition-base);
        }
        
        .dropdown-item:hover i {
            opacity: 1;
            transform: scale(1.1);
        }
        
        .dropdown-divider {
            border-color: var(--neutral-200);
            margin: 0.75rem 0;
        }
        
        /* Language switcher stability */
        .language-switcher {
            visibility: visible !important;
            opacity: 1 !important;
            position: relative;
        }
        
        .language-switcher .btn {
            visibility: visible !important;
            opacity: 1 !important;
            transition: background-color 0.15s ease, color 0.15s ease, border-color 0.15s ease;
        }
        
        /* Body adjustments for enhanced navbar */
        body {
            padding-top: 100px;
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--primary-25) 100%);
            min-height: 100vh;
        }
        
        /* Main content styling */
        main {
            min-height: calc(100vh - 100px);
            position: relative;
        }
        
        /* Page transitions */
        .page-transition {
            animation: pageSlideIn 0.3s ease-out;
        }
        
        @keyframes pageSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <script>
        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="navbar fixed-top" aria-label="Primary navigation">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-tools me-2"></i>
                    {{ __('ui.app_name') }}
                </a>
                
                <div class="navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto" aria-label="Primary">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ localized_route('home') }}">
                                <i class="fas fa-home me-1"></i>{{ __('ui.home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ localized_route('tasks.index') }}">
                                <i class="fas fa-list me-1"></i>{{ __('ui.tasks') }}
                            </a>
                        </li>
                        @auth
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ localized_route('tasks.my') }}">
                                    <i class="fas fa-user-tasks me-1"></i>{{ __('ui.my_tasks') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ localized_route('tasks.create') }}">
                                    <i class="fas fa-plus me-1"></i>{{ __('ui.create_task') }}
                                </a>
                            </li>
                        @endauth
                    </ul>
                    
                    <ul class="navbar-nav" aria-label="Secondary">
                        <!-- Language Switcher -->
                        <li class="nav-item">
                            @include('components.language-switcher')
                        </li>
                        
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ localized_route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>{{ __('auth.login') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ localized_route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i>{{ __('auth.register') }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- Dashboard Link in Dropdown -->
                                    @if(Auth::user()->role === 'admin')
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>{{ __('ui.dashboard') }}
                                        </a></li>
                                    @elseif(Auth::user()->role === 'client')
                                        <li><a class="dropdown-item" href="{{ localized_route('dashboard.client') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>{{ __('ui.dashboard') }}
                                        </a></li>
                                    @elseif(Auth::user()->role === 'tasker')
                                        <li><a class="dropdown-item" href="{{ localized_route('dashboard.tasker') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>{{ __('ui.dashboard') }}
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ localized_route('tasker.profile.edit') }}">
                                            <i class="fas fa-user-cog me-2"></i>{{ __('ui.edit_profile_title') }}
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ localized_route('tasker.portfolio.index') }}">
                                            <i class="fas fa-images me-2"></i>{{ __('ui.portfolio') }}
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ localized_route('tasker.profile.show', ['id' => Auth::id()]) }}">
                                            <i class="fas fa-eye me-2"></i>{{ __('ui.view') }} {{ __('ui.profile') }}
                                        </a></li>
                                    @endif
                                    
                                    <li><a class="dropdown-item" href="{{ localized_route('profile.edit') }}">
                                        <i class="fas fa-user-edit me-2"></i>{{ __('ui.profile') }}
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ localized_route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('auth.logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>

                <button class="navbar-toggler" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" data-m3-nav-toggle>
                    <span class="m3-hamburger" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="page-transition">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            const toggle = document.querySelector('[data-m3-nav-toggle]');
            const nav = document.getElementById('navbarNav');
            if (!toggle || !nav) return;

                // Mobile breakpoint: ≤ 768px uses the vertical overlay menu (CSS in resources/css/app.css)
            const setOpen = (open) => {
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    nav.setAttribute('aria-hidden', open ? 'false' : 'true');
                nav.classList.toggle('is-open', open);
            };

            const isOpen = () => toggle.getAttribute('aria-expanded') === 'true';

                setOpen(false);
            toggle.addEventListener('click', () => setOpen(!isOpen()));

            nav.addEventListener('click', (e) => {
                const link = e.target.closest('a');
                if (!link) return;
                if (link.classList.contains('dropdown-toggle')) return;
                setOpen(false);
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') setOpen(false);
            });

            document.addEventListener('pointerdown', (e) => {
                if (!isOpen()) return;
                if (nav.contains(e.target) || toggle.contains(e.target)) return;
                setOpen(false);
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) setOpen(false);
            });

            if ('ontouchstart' in window || (navigator.maxTouchPoints || 0) > 0) {
                document.documentElement.classList.add('m3-touch');
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
