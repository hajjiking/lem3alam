<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Database\Eloquent\Model::preventLazyLoading(! app()->isProduction());
        \Illuminate\Database\Eloquent\Model::unguard();
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        Gate::before(function ($user, string $ability) {
            if ($user instanceof User && $user->isSuperAdmin()) {
                return true;
            }

            return null;
        });

        foreach ([
            'manage_users',
            'manage_workers',
            'manage_tasks',
            'manage_categories',
            'manage_reports',
            'manage_reviews',
            'manage_notifications',
            'manage_payments',
            'manage_disputes',
            'manage_content',
            'manage_settings',
            'view_analytics',
            'view_audit_logs',
        ] as $ability) {
            Gate::define($ability, function ($user) use ($ability) {
                return $user instanceof User && $user->hasPermission($ability);
            });
        }

        if ((bool) config('app.force_https') || str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
