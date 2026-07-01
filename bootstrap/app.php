<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register the SetLocale middleware globally
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\AccountStatusMiddleware::class,
        ]);

        $middleware->api(append: [
            \App\Http\Middleware\AccountStatusMiddleware::class,
        ]);

        // Register middleware aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'admin.timeout' => \App\Http\Middleware\AdminSessionTimeout::class,
            'admin.permission' => \App\Http\Middleware\AdminPermissionMiddleware::class,
            'admin.audit' => \App\Http\Middleware\AdminAuditLogMiddleware::class,
            'locale' => \App\Http\Middleware\SetLocale::class,
            'locale.auth' => \App\Http\Middleware\LocaleAwareAuth::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'jwt' => \App\Http\Middleware\JwtAuthenticate::class,
            'account.status' => \App\Http\Middleware\AccountStatusMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
