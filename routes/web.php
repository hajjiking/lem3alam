<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\CategoryManagementController;
use App\Http\Controllers\Admin\DisputeManagementController;
use App\Http\Controllers\Admin\PaymentManagementController;
use App\Http\Controllers\Admin\TaskManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// =======================
// Debug route (temporary)
// =======================
if (app()->environment('local')) {
    Route::get('/debug-auth', function () {
        $html = '<h2>Authentication Debug</h2>';

        if (Auth::check()) {
            $user = Auth::user();
            $html .= "<p style='color: green;'>✓ User is authenticated</p>";
            $html .= '<p>User ID: '.$user->id.'</p>';
            $html .= '<p>User Email: '.$user->email.'</p>';
            $html .= '<p>User Role: '.$user->role.'</p>';

            if ($user->role === 'client') {
                $html .= "<p style='color: green;'>✓ User has 'client' role</p>";
            } else {
                $html .= "<p style='color: red;'>✗ User does NOT have 'client' role</p>";
            }
        } else {
            $html .= "<p style='color: red;'>✗ User is NOT authenticated</p>";
        }

        $html .= '<h3>Session Info:</h3>';
        $html .= '<p>Session ID: '.session()->getId().'</p>';
        $html .= '<p>CSRF Token: '.csrf_token().'</p>';

        $html .= '<h3>Test Links:</h3>';
        $html .= "<p><a href='/login'>Login Page</a></p>";
        $html .= "<p><a href='/ar/tasks/create'>Task Creation (Arabic)</a></p>";
        $html .= "<p><a href='/tasks/create'>Task Creation (English)</a></p>";

        return $html;
    });
}

// =======================
// Language switching route
// =======================
Route::get('/language/{locale}', function ($locale) {
    $supportedLocales = config('app.supported_locales', ['ar', 'fr', 'en']);

    if (in_array($locale, $supportedLocales)) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }

    $currentUrl = url()->previous();
    $segments = explode('/', parse_url($currentUrl, PHP_URL_PATH));

    if (count($segments) > 1 && in_array($segments[1], $supportedLocales)) {
        array_splice($segments, 1, 1);
    }
    array_splice($segments, 1, 0, $locale);

    return redirect(implode('/', $segments));
})->name('language.switch');

Route::get('/storage/{path}', function (string $path) {
    $path = ltrim($path, '/');
    if (str_contains($path, '..')) {
        abort(404);
    }
    if (! Str::startsWith($path, 'task_images/')) {
        abort(404);
    }
    if (! Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path), [
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*');

// =======================
// Admin routes (not localized)
// =======================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    })->name('root');

    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('authenticate');

    Route::get('/password/reset', [AdminController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [AdminController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [AdminController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [AdminController::class, 'reset'])->name('password.update');

    Route::get('/otp', [AdminController::class, 'showOtpForm'])->name('otp.show');
    Route::post('/otp', [AdminController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/otp/resend', [AdminController::class, 'resendOtp'])->name('otp.resend');

    Route::middleware(['admin', 'admin.timeout', 'admin.audit'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('admin.permission:view_analytics')->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        Route::get('audit-logs', [AuditLogController::class, 'index'])->middleware('admin.permission:view_audit_logs')->name('audit-logs.index');

        Route::middleware('admin.permission:manage_users')->group(function () {
            Route::resource('users', UserManagementController::class);
            Route::patch('users/{user}/toggle-status', [UserManagementController::class, 'toggleStatus'])->name('users.toggle-status');
            Route::patch('users/{user}/verify', [UserManagementController::class, 'verify'])->name('users.verify');
            Route::patch('users/{user}/suspend', [UserManagementController::class, 'suspend'])->name('users.suspend');
            Route::patch('users/{user}/ban', [UserManagementController::class, 'ban'])->name('users.ban');
            Route::post('users/{user}/password-reset', [UserManagementController::class, 'sendPasswordReset'])->name('users.password-reset');
            Route::post('users/{id}/restore', [UserManagementController::class, 'restore'])->name('users.restore');
        });

        Route::middleware('admin.permission:manage_tasks')->group(function () {
            Route::resource('tasks', TaskManagementController::class);
            Route::patch('tasks/{task}/update-status', [TaskManagementController::class, 'updateStatus'])->name('tasks.update-status');
        });

        Route::middleware('admin.permission:manage_categories')->group(function () {
            Route::resource('categories', CategoryManagementController::class);
            Route::post('categories/{category}/merge', [CategoryManagementController::class, 'merge'])->name('categories.merge');
        });

        Route::middleware('admin.permission:manage_payments')->group(function () {
            Route::resource('payments', PaymentManagementController::class);
        });

        Route::middleware('admin.permission:manage_disputes')->group(function () {
            Route::resource('disputes', DisputeManagementController::class);
            Route::patch('disputes/{dispute}/resolve', [DisputeManagementController::class, 'resolve'])->name('disputes.resolve');
        });

        Route::get('reports', [AdminController::class, 'reports'])->middleware('admin.permission:view_analytics')->name('reports');
    });
});

// =======================
// Redirect root to default locale
// =======================
Route::get('/', function () {
    $locale = Session::get('locale', config('app.locale', 'ar'));

    return redirect("/{$locale}");
});

// =======================
// Localized routes
// =======================
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'ar|fr|en'],
    'middleware' => ['web', 'locale'],
], function () {

    // Homepage
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Static pages
    Route::view('/how-it-works', 'pages.how-it-works')->name('how-it-works');
    Route::view('/pricing', 'pages.pricing')->name('pricing');
    Route::view('/tasker-guide', 'pages.tasker-guide')->name('tasker-guide');
    Route::view('/success-stories', 'pages.success-stories')->name('success-stories');
    Route::view('/help', 'pages.help')->name('help');
    Route::view('/contact', 'pages.contact')->name('contact');
    Route::view('/safety', 'pages.safety')->name('safety');
    Route::view('/trust', 'pages.trust')->name('trust');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/careers', 'pages.careers')->name('careers');
    Route::view('/press', 'pages.press')->name('press');
    Route::view('/blog', 'pages.blog')->name('blog');
    Route::view('/privacy', 'pages.privacy')->name('privacy');
    Route::view('/terms', 'pages.terms')->name('terms');
    Route::view('/cookies', 'pages.cookies')->name('cookies');

    // ========== Authentication ==========
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');
    });

    Route::get('/auth/{provider}/redirect', [\App\Http\Controllers\Auth\SocialLoginController::class, 'redirect'])->name('social.redirect');
    Route::match(['get', 'post'], '/auth/{provider}/callback', [\App\Http\Controllers\Auth\SocialLoginController::class, 'callback'])->name('social.callback');

    // ========== Public task browsing ==========
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/search', [TaskController::class, 'search'])->name('tasks.search');
    // Redirect legacy/public test route to protected create route
    Route::get('/tasks/create-test', function () {
        return redirect(localized_route('tasks.create'));
    })->name('tasks.create.test');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

    // ========== Public task viewing (must be after specific routes) ==========
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show')->where('id', '[0-9]+');

    // ========== Public tasker profile ==========
    Route::get('/taskers/{id}', [\App\Http\Controllers\TaskerProfileController::class, 'show'])->name('tasker.profile.show');

    // ========== Authenticated ==========
    Route::middleware('locale.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', function () {
            $user = \Illuminate\Support\Facades\Auth::user();

            return $user->role === 'tasker'
                ? redirect(localized_route('dashboard.tasker'))
                : redirect(localized_route('dashboard.client'));
        })->name('dashboard');

        // Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Messages
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('throttle:30,1');
        Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply')->middleware('throttle:30,1');

        // My Tasks
        Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.my');

        // Tasker Profile System
        Route::get('/taskers/me', function () {
            $id = \Illuminate\Support\Facades\Auth::id();

            return $id
                ? redirect(localized_route('tasker.profile.show', $id))
                : redirect(localized_route('login'));
        })->name('tasker.profile.me');

        Route::middleware('role:tasker')->group(function () {
            // Profile management
            Route::get('/profile/tasker', function () {
                return redirect(localized_route('tasker.profile.edit'));
            });
            Route::get('/profile/tasker/edit', [\App\Http\Controllers\TaskerProfileController::class, 'edit'])->name('tasker.profile.edit');
            Route::put('/profile/tasker', [\App\Http\Controllers\TaskerProfileController::class, 'update'])->name('tasker.profile.update');

            // Portfolio management
            Route::get('/portfolio', [\App\Http\Controllers\TaskerProfileController::class, 'portfolioIndex'])->name('tasker.portfolio.index');
            Route::get('/portfolio/create', [\App\Http\Controllers\TaskerProfileController::class, 'portfolioCreate'])->name('tasker.portfolio.create');
            Route::post('/portfolio', [\App\Http\Controllers\TaskerProfileController::class, 'portfolioStore'])->name('tasker.portfolio.store');
            Route::get('/portfolio/{id}/edit', [\App\Http\Controllers\TaskerProfileController::class, 'portfolioEdit'])->name('tasker.portfolio.edit');
            Route::put('/portfolio/{id}', [\App\Http\Controllers\TaskerProfileController::class, 'portfolioUpdate'])->name('tasker.portfolio.update');
            Route::delete('/portfolio/{id}', [\App\Http\Controllers\TaskerProfileController::class, 'portfolioDestroy'])->name('tasker.portfolio.destroy');

            // Task workflow (tasker)
            Route::post('/tasks/{id}/submit-completion', [TaskController::class, 'submitCompletion'])->name('tasks.submitCompletion');
        });

        // Task management (protected)
        Route::middleware('role:client')->group(function () {
            Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
            Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
            Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
            Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
            Route::post('/applications/{application}/accept', [TaskController::class, 'acceptApplication'])->name('applications.accept');
            Route::post('/applications/{application}/reject', [TaskController::class, 'rejectApplication'])->name('applications.reject');
            // Client approval of completion
            Route::post('/tasks/{id}/approve-completion', [TaskController::class, 'approveCompletion'])->name('tasks.approveCompletion');
            Route::post('/tasks/{id}/decline-completion', [TaskController::class, 'declineCompletion'])->name('tasks.declineCompletion');
        });
        Route::post('/tasks/{id}/apply', [TaskController::class, 'apply'])->name('tasks.apply');

        // Review routes (authenticated users)
        Route::middleware('role:client')->group(function () {
            Route::get('/taskers/{tasker}/reviews/create/{task?}', [\App\Http\Controllers\ReviewController::class, 'create'])->name('reviews.create');
            Route::post('/taskers/{tasker}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
            Route::get('/reviews/{review}/edit', [\App\Http\Controllers\ReviewController::class, 'edit'])->name('reviews.edit');
            Route::put('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
            Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
        });
        // Localized public review index
        Route::get('/taskers/{tasker}/reviews', [\App\Http\Controllers\ReviewController::class, 'index'])->name('reviews.index');

        // Dashboards
        Route::view('/dashboard/client', 'dashboard.client')->name('dashboard.client');
        Route::view('/dashboard/tasker', 'dashboard.tasker')->name('dashboard.tasker');
    });
});

// Public review routes (no authentication required)
Route::get('/taskers/{tasker}/reviews', [\App\Http\Controllers\ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'show'])->name('reviews.show');
Route::get('/api/taskers/{tasker}/reviews', [\App\Http\Controllers\ReviewController::class, 'getReviews'])->name('api.reviews.get');
