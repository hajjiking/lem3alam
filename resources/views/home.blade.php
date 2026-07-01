@extends('layouts.app')

@section('title', __('ui.app_name') . ' - Find & Hire Local Services')
@section('description', __('ui.app_name') . ' connects you with skilled professionals for all your service needs. Post tasks, find experts, and get things done efficiently.')

@section('content')
<header class="hero-header page-hero-gradient">
    <div class="hero-header__bg" aria-hidden="true"></div>
    <div class="ui-container hero-header__container">
        <div class="hero-header__grid">
            <div class="hero-header__content">
                <div class="hero-header__badge">
                    <i class="fa-solid fa-star" aria-hidden="true"></i>
                    <span>{{ __('ui.trusted_platform') }}</span>
                </div>

                <h1 class="hero-header__title">
                    {{ __('ui.hero_title') }}
                </h1>

                <p class="hero-header__subtitle">
                    {{ __('ui.hero_subtitle') }}
                </p>

                <div class="hero-header__actions">
                    <a href="{{ localized_route('tasks.create') }}" class="ui-btn hero-btn-primary">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                        <span>{{ __('ui.post_task') }}</span>
                    </a>
                    <a href="{{ localized_route('tasks.index') }}" class="ui-btn hero-btn-secondary">
                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                        <span>{{ __('ui.find_work') }}</span>
                    </a>
                </div>

                <dl class="hero-header__stats">
                    <div class="hero-stat">
                        <dt class="hero-stat__label">{{ __('ui.users_count') }}</dt>
                        <dd class="hero-stat__value">{{ number_format($stats['total_users'] ?? 0) }}+</dd>
                    </div>
                    <div class="hero-stat">
                        <dt class="hero-stat__label">{{ __('ui.tasks_count') }}</dt>
                        <dd class="hero-stat__value">{{ number_format($stats['total_tasks'] ?? 0) }}+</dd>
                    </div>
                    <div class="hero-stat">
                        <dt class="hero-stat__label">{{ __('ui.rating') }}</dt>
                        <dd class="hero-stat__value">4.8/5</dd>
                    </div>
                </dl>
            </div>

            <div class="hero-header__media" aria-hidden="true">
                <div class="hero-header__art">
                    <svg viewBox="0 0 560 420" fill="none" xmlns="http://www.w3.org/2000/svg" class="hero-header__svg" focusable="false">
                        <defs>
                            <linearGradient id="m3-hero-g" x1="60" y1="40" x2="500" y2="380" gradientUnits="userSpaceOnUse">
                                <stop stop-color="rgba(255,255,255,0.95)" />
                                <stop offset="1" stop-color="rgba(255,255,255,0.55)" />
                            </linearGradient>
                            <linearGradient id="m3-hero-accent" x1="80" y1="90" x2="520" y2="330" gradientUnits="userSpaceOnUse">
                                <stop stop-color="rgba(255,255,255,0.22)" />
                                <stop offset="1" stop-color="rgba(255,255,255,0.05)" />
                            </linearGradient>
                        </defs>

                        <rect x="36" y="36" width="488" height="348" rx="28" fill="url(#m3-hero-accent)" />
                        <rect x="70" y="84" width="250" height="52" rx="18" stroke="url(#m3-hero-g)" stroke-width="2" opacity="0.9" />
                        <rect x="70" y="156" width="360" height="18" rx="9" fill="rgba(255,255,255,0.55)" />
                        <rect x="70" y="188" width="300" height="18" rx="9" fill="rgba(255,255,255,0.35)" />
                        <rect x="70" y="240" width="160" height="44" rx="16" fill="rgba(255,255,255,0.9)" />
                        <rect x="244" y="240" width="160" height="44" rx="16" fill="rgba(255,255,255,0.16)" />
                        <circle cx="452" cy="128" r="46" fill="rgba(255,255,255,0.12)" />
                        <path d="M452 104c5.5 0 10 4.5 10 10v28c0 5.5-4.5 10-10 10s-10-4.5-10-10v-28c0-5.5 4.5-10 10-10Z" fill="rgba(255,255,255,0.85)" />
                        <path d="M452 110c10.5 0 19 8.5 19 19 0 8.4-5.4 15.5-13 18.1" stroke="rgba(255,255,255,0.85)" stroke-width="6" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="hero-header__scroll">
            <a href="#how-it-works" class="hero-scroll-link">
                <span>{{ __('ui.scroll_down') }}</span>
                <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</header>



<!-- How It Works -->
<section id="how-it-works" class="how-it-works">
    <div class="ui-container">
        <div class="how-it-works__head">
            <span class="ui-badge how-it-works__badge">{{ __('ui.process') }}</span>
            <h2 class="how-it-works__title">{{ __('ui.how_it_works') }}</h2>
            <p class="how-it-works__subtitle">{{ __('ui.how_it_works_subtitle') }}</p>
        </div>

        <div class="hiw-grid">
            <div class="hiw-card">
                <div class="hiw-card__step" aria-hidden="true">1</div>
                <div class="hiw-card__icon" aria-hidden="true">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div class="hiw-card__title">{{ __('ui.step_1_title') }}</div>
                <div class="hiw-card__desc">{{ __('ui.step_1_desc') }}</div>
            </div>

            <div class="hiw-card">
                <div class="hiw-card__step hiw-card__step--accent" aria-hidden="true">2</div>
                <div class="hiw-card__icon hiw-card__icon--accent" aria-hidden="true">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="hiw-card__title">{{ __('ui.step_2_title') }}</div>
                <div class="hiw-card__desc">{{ __('ui.step_2_desc') }}</div>
            </div>

            <div class="hiw-card">
                <div class="hiw-card__step hiw-card__step--success" aria-hidden="true">3</div>
                <div class="hiw-card__icon hiw-card__icon--success" aria-hidden="true">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="hiw-card__title">{{ __('ui.step_3_title') }}</div>
                <div class="hiw-card__desc">{{ __('ui.step_3_desc') }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Categories -->
<section class="popular-categories">
    <div class="ui-container">
        <div class="popular-categories__head">
            <span class="ui-badge popular-categories__badge">{{ __('ui.categories') }}</span>
            <h2 class="popular-categories__title">{{ __('ui.popular_categories') }}</h2>
            <p class="popular-categories__subtitle">{{ __('ui.popular_categories_subtitle') }}</p>
        </div>

        <div class="pc-grid">
            @foreach($categories as $category)
                @if($category && $category->getName(app()->getLocale()))
                    @php($minBudget = \App\Models\Task::where('category_id', $category->id)->min('budget_min'))
                    <a href="{{ localized_route('tasks.index', ['category' => $category->id]) }}" class="pc-card">
                        <div class="pc-card__media" aria-hidden="true">
                            @if(! empty($category->image_url))
                                <img src="{{ $category->image_url }}" alt="" class="pc-card__img" loading="lazy" decoding="async">
                            @else
                                <div class="pc-card__fallback">
                                    <i class="fa-solid fa-{{ $category->icon ?? 'layer-group' }}"></i>
                                </div>
                            @endif
                        </div>
                        <div class="pc-card__body">
                            <div class="pc-card__title">{{ $category->getName(app()->getLocale()) }}</div>
                            <div class="pc-card__meta">
                                {{ __('ui.projects_starting_at', ['price' => ($minBudget ? number_format($minBudget).' '.__('tasks.currency') : __('ui.explore_projects'))]) }}
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Tasks -->
<section class="latest-tasks">
    <div class="ui-container">
        <div class="latest-tasks__head">
            <div class="min-w-0">
                <span class="ui-badge latest-tasks__badge">{{ __('ui.featured') }}</span>
                <h2 class="latest-tasks__title">{{ __('ui.latest_tasks') }}</h2>
                <p class="latest-tasks__subtitle">{{ __('ui.latest_tasks_subtitle') }}</p>
            </div>
            <a href="{{ localized_route('tasks.index') }}" class="ui-btn ui-btn-secondary">
                <span>{{ __('ui.view_all_tasks') }}</span>
                <i class="fa-solid fa-arrow-right rtl:rotate-180" aria-hidden="true"></i>
            </a>
        </div>

        <div class="lt-grid">
            @foreach($featured_tasks as $task)
                <div class="lt-card">
                    <div class="lt-card__top">
                        <div class="min-w-0">
                            <div class="lt-card__title">{{ $task->title }}</div>
                        </div>
                        <span class="lt-badge lt-badge--{{ $task->urgency }}">{{ ucfirst($task->urgency) }}</span>
                    </div>

                    <div class="lt-card__desc">{{ Str::limit($task->description, 120) }}</div>

                    <div class="lt-card__meta">
                        <div class="lt-meta">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                            <span class="truncate">{{ $task->location }}</span>
                        </div>
                        <div class="lt-price">{{ number_format($task->budget_min) }} - {{ number_format($task->budget_max) }} MAD</div>
                    </div>

                    <div class="lt-card__bottom">
                        <div class="lt-meta ui-muted">
                            <i class="fa-regular fa-clock" aria-hidden="true"></i>
                            <span>{{ $task->created_at->diffForHumans() }}</span>
                        </div>
                        <a href="{{ localized_route('tasks.show', $task->id) }}" class="ui-btn ui-btn-primary">
                            <span>{{ __('ui.view_details') }}</span>
                            <i class="fa-solid fa-arrow-right rtl:rotate-180" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Trust & Safety -->
<section id="trust-safety" class="trust-safety page-hero-gradient">
    <div class="trust-safety__bg" aria-hidden="true"></div>

    <div class="ui-container trust-safety__container">
        <div class="trust-safety__grid">
            <div class="trust-safety__content">
                <span class="ui-badge trust-safety__badge">{{ __('ui.trust_safety') }}</span>
                <h2 class="trust-safety__title">{{ __('ui.safety_priority') }}</h2>

                <ul class="trust-safety__list">
                    <li class="ts-item">
                        <div class="ts-item__icon" aria-hidden="true"><i class="fa-solid fa-shield-halved"></i></div>
                        <div class="ts-item__body">
                            <div class="ts-item__title">{{ __('ui.verified_profiles') }}</div>
                            <div class="ts-item__desc">{{ __('ui.verified_profiles_desc') }}</div>
                        </div>
                    </li>

                    <li class="ts-item">
                        <div class="ts-item__icon" aria-hidden="true"><i class="fa-solid fa-lock"></i></div>
                        <div class="ts-item__body">
                            <div class="ts-item__title">{{ __('ui.secure_payments') }}</div>
                            <div class="ts-item__desc">{{ __('ui.secure_payments_desc') }}</div>
                        </div>
                    </li>

                    <li class="ts-item">
                        <div class="ts-item__icon" aria-hidden="true"><i class="fa-solid fa-headset"></i></div>
                        <div class="ts-item__body">
                            <div class="ts-item__title">{{ __('ui.support_24_7') }}</div>
                            <div class="ts-item__desc">{{ __('ui.support_24_7_desc') }}</div>
                        </div>
                    </li>

                    <li class="ts-item">
                        <div class="ts-item__icon" aria-hidden="true"><i class="fa-solid fa-star"></i></div>
                        <div class="ts-item__body">
                            <div class="ts-item__title">{{ __('ui.quality_guarantee') }}</div>
                            <div class="ts-item__desc">{{ __('ui.quality_guarantee_desc') }}</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="trust-safety__media" aria-hidden="true">
                <div class="trust-safety__art">
                    <svg viewBox="0 0 560 420" fill="none" xmlns="http://www.w3.org/2000/svg" class="trust-safety__svg" focusable="false">
                        <defs>
                            <linearGradient id="ts-g" x1="80" y1="60" x2="520" y2="360" gradientUnits="userSpaceOnUse">
                                <stop stop-color="rgba(255,255,255,0.95)" />
                                <stop offset="1" stop-color="rgba(255,255,255,0.55)" />
                            </linearGradient>
                            <linearGradient id="ts-a" x1="80" y1="80" x2="520" y2="340" gradientUnits="userSpaceOnUse">
                                <stop stop-color="rgba(255,255,255,0.18)" />
                                <stop offset="1" stop-color="rgba(255,255,255,0.04)" />
                            </linearGradient>
                        </defs>

                        <rect x="54" y="48" width="452" height="320" rx="28" fill="url(#ts-a)" />
                        <path d="M280 110c44 0 80 36 80 80 0 74-80 128-80 128s-80-54-80-128c0-44 36-80 80-80Z" stroke="url(#ts-g)" stroke-width="10" opacity="0.92" />
                        <path d="M252 208l18 18 40-44" stroke="rgba(255,255,255,0.9)" stroke-width="12" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="130" cy="120" r="18" fill="rgba(255,255,255,0.18)" />
                        <circle cx="440" cy="130" r="14" fill="rgba(255,255,255,0.14)" />
                        <circle cx="452" cy="292" r="22" fill="rgba(255,255,255,0.12)" />
                    </svg>

                    <div class="trust-safety__chip trust-safety__chip--top" aria-hidden="true">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="trust-safety__chip trust-safety__chip--bottom" aria-hidden="true">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section - Only show for guests -->
@guest
<section class="py-5" style="background: linear-gradient(135deg, var(--neutral-25) 0%, var(--primary-25) 50%, var(--accent-25) 100%); position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: radial-gradient(circle at 30% 70%, rgba(var(--primary-500-rgb), 0.1) 0%, transparent 50%), radial-gradient(circle at 70% 30%, rgba(var(--accent-500-rgb), 0.1) 0%, transparent 50%); z-index: 1;"></div>
    
    <div class="container text-center position-relative" style="z-index: 2;">
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-4" style="font-size: 0.9rem; font-weight: 600;">
            {{ __('ui.get_started') ?? 'Get Started' }}
        </span>
        <h2 class="hero-title mb-4" style="font-size: 3rem; background: linear-gradient(135deg, var(--primary-600), var(--accent-600)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ __('ui.ready_to_start') }}</h2>
        <p class="hero-subtitle text-muted mb-5" style="font-size: 1.3rem; max-width: 700px; margin: 0 auto; color: var(--neutral-500);">{{ __('ui.cta_subtitle') }}</p>
        
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-4">
            <a href="{{ localized_route('register') }}?type=client" class="btn btn-primary-modern btn-lg" style="padding: 1rem 2.5rem; font-weight: 700; font-size: 1.1rem; border-radius: var(--radius-xl); background: linear-gradient(135deg, var(--primary-500), var(--primary-600)); border: none; color: white; text-decoration: none; display: inline-flex; align-items: center; gap: 0.75rem; transition: all var(--transition-base); box-shadow: var(--shadow-lg); min-width: 250px; justify-content: center;">
                <i class="fas fa-user-plus" style="font-size: 1.2rem;"></i>{{ __('ui.i_need_services') }}
            </a>
            <div class="text-muted fw-semibold" style="font-size: 1.1rem;">{{ __('ui.or') ?? 'OR' }}</div>
            <a href="{{ localized_route('register') }}?type=tasker" class="btn btn-outline-primary btn-lg" style="padding: 1rem 2.5rem; font-weight: 700; font-size: 1.1rem; border-radius: var(--radius-xl); border: 2px solid var(--primary-500); color: var(--primary-600); background: rgba(255,255,255,0.9); backdrop-filter: blur(3px); text-decoration: none; display: inline-flex; align-items: center; gap: 0.75rem; transition: all var(--transition-base); box-shadow: var(--shadow-md); min-width: 250px; justify-content: center;">
                <i class="fas fa-briefcase" style="font-size: 1.2rem;"></i>{{ __('ui.i_offer_services') }}
            </a>
        </div>
        
        <div class="mt-5 pt-4" style="border-top: 1px solid rgba(var(--neutral-300-rgb), 0.5);">
            <p class="text-muted mb-0" style="font-size: 0.95rem;">
                {{ __('ui.join_thousands') ?? 'Join thousands of satisfied users' }} 
                <span class="fw-semibold text-primary">{{ __('ui.trusted_platform') ?? 'on our trusted platform' }}</span>
            </p>
        </div>
    </div>
    
    <style>
    .btn-primary-modern:hover {
        background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
    }
    
    .btn-outline-primary:hover {
        background: var(--primary-500);
        color: white;
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-500);
    }
    </style>
</section>
@endguest
@endsection
