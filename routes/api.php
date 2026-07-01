<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DisputeController;
use App\Http\Controllers\Api\KycController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\RealtimeMessageController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CitiesController;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::get('/', function () {
        return response()->json([
            'success' => true,
            'data' => [
                'name' => config('app.name'),
                'version' => 1,
            ],
        ]);
    });

    // Public routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::get('/taskers/{user}', function (User $user) {
        if (! $user->isTasker()) {
            return response()->json([
                'success' => false,
                'message' => 'Tasker not found',
            ], 404);
        }

        $user->load([
            'verifiedSkills.category',
            'activePortfolioItems.category',
            'socialAccounts',
        ]);

        $averageRating = Review::approved()
            ->where(function ($q) use ($user) {
                $q->where('tasker_id', $user->id)
                    ->orWhere('reviewee_id', $user->id);
            })
            ->avg('rating') ?? 0;

        $totalReviews = Review::approved()
            ->where(function ($q) use ($user) {
                $q->where('tasker_id', $user->id)
                    ->orWhere('reviewee_id', $user->id);
            })
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'city' => $user->city,
                'address' => $user->address,
                'bio' => $user->getBio(app()->getLocale()),
                'phone' => $user->phone,
                'profile_image' => $user->profile_image,
                'hourly_rate' => $user->hourly_rate,
                'available' => (bool) $user->available,
                'is_verified' => (bool) $user->is_verified,
                'average_rating' => round((float) $averageRating, 2),
                'total_reviews' => (int) $totalReviews,
                'skills' => $user->verifiedSkills->map(function ($skill) {
                    return [
                        'id' => $skill->id,
                        'name' => $skill->getName(app()->getLocale()),
                        'category' => $skill->category?->getName(app()->getLocale()),
                        'experience_level' => $skill->pivot?->experience_level,
                        'years_experience' => $skill->pivot?->years_experience,
                        'description' => $skill->pivot?->description,
                        'is_verified' => (bool) ($skill->pivot?->is_verified ?? false),
                    ];
                })->values(),
                'portfolio' => $user->activePortfolioItems->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        'description' => $item->description,
                        'image_path' => $item->image_path,
                        'image_alt' => $item->image_alt,
                        'category' => $item->category?->getName(app()->getLocale()),
                        'tags' => $item->tags ?? [],
                        'is_featured' => (bool) $item->is_featured,
                    ];
                })->values(),
                'social_accounts' => $user->socialAccounts->map(function ($acc) {
                    return [
                        'provider' => $acc->provider,
                        'name' => $acc->name,
                        'email' => $acc->email,
                    ];
                })->values(),
            ],
        ]);
    });
    Route::get('/taskers/{user}/reviews', function (Request $request, User $user) {
        if (! $user->isTasker()) {
            return response()->json([
                'success' => false,
                'message' => 'Tasker not found',
            ], 404);
        }

        $perPage = (int) $request->input('per_page', 10);
        $rating = $request->input('rating');
        $from = $request->input('from');
        $to = $request->input('to');
        $sort = (string) $request->input('sort', 'newest');

        $query = Review::approved()
            ->where(function ($q) use ($user) {
                $q->where('tasker_id', $user->id)
                    ->orWhere('reviewee_id', $user->id);
            })
            ->with(['reviewer:id,name,profile_image', 'task:id,title']);

        if ($rating !== null && $rating !== '' && (int) $rating >= 1 && (int) $rating <= 5) {
            $query->where('rating', (int) $rating);
        }

        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'rating_high':
                $query->orderBy('rating', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'rating_low':
                $query->orderBy('rating', 'asc')->orderBy('created_at', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $reviews = $query->paginate($perPage);

        $averageRating = Review::approved()
            ->where(function ($q) use ($user) {
                $q->where('tasker_id', $user->id)
                    ->orWhere('reviewee_id', $user->id);
            })
            ->avg('rating') ?? 0;

        $totalReviews = Review::approved()
            ->where(function ($q) use ($user) {
                $q->where('tasker_id', $user->id)
                    ->orWhere('reviewee_id', $user->id);
            })
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'reviews' => $reviews,
                'average_rating' => round((float) $averageRating, 2),
                'total_reviews' => (int) $totalReviews,
            ],
        ]);
    });

    // Cities routes
    Route::get('/cities/regions', [CitiesController::class, 'getRegions']);
    Route::get('/cities/major', [CitiesController::class, 'getMajorCities']);
    Route::get('/cities/all', [CitiesController::class, 'getAllCities']);
    Route::get('/cities/search', [CitiesController::class, 'searchCities']);
    Route::get('/cities/region/{region}', [CitiesController::class, 'getCitiesByRegion']);
    Route::get('/cities/{city}', [CitiesController::class, 'getCityInfo']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // Authentication
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);

        // User Management
        Route::get('/profile', [UserController::class, 'profile']);
        Route::put('/profile', [UserController::class, 'updateProfile']);
        Route::post('/profile/avatar', [UserController::class, 'uploadAvatar']);
        Route::delete('/profile/avatar', [UserController::class, 'deleteAvatar']);

        // Location
        Route::post('/location/update', [LocationController::class, 'update']);
        Route::get('/providers/nearby', [ProviderController::class, 'nearby']);

        // KYC
        Route::get('/kyc/documents', [KycController::class, 'index']);
        Route::post('/kyc/documents', [KycController::class, 'submit']);

        // Reports
        Route::get('/reports/mine', [ReportController::class, 'mine']);
        Route::post('/reports', [ReportController::class, 'store']);

        // Tasks
        Route::post('/tasks', [TaskController::class, 'store']);
        Route::put('/tasks/{task}', [TaskController::class, 'update']);
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
        Route::post('/tasks/{task}/apply', [TaskController::class, 'apply']);
        Route::get('/my-tasks', [TaskController::class, 'myTasks']);
        Route::get('/my-applications', [TaskController::class, 'myApplications']);

        // Task Applications
        Route::put('/applications/{application}/accept', [TaskController::class, 'acceptApplication']);
        Route::put('/applications/{application}/reject', [TaskController::class, 'rejectApplication']);

        // Messages
        Route::get('/messages', [MessageController::class, 'index']);
        Route::post('/messages', [MessageController::class, 'store']);
        Route::put('/messages/{message}/read', [MessageController::class, 'markAsRead']);
        Route::get('/conversations/{userId}', [MessageController::class, 'conversation']);

        // Payments
        Route::post('/payments', [PaymentController::class, 'store']);
        Route::get('/payments', [PaymentController::class, 'index']);
        Route::put('/payments/{payment}/release', [PaymentController::class, 'release']);

        // Reviews
        Route::post('/reviews', [ReviewController::class, 'store']);
        Route::get('/reviews/{userId}', [ReviewController::class, 'userReviews']);

        // Disputes
        Route::post('/disputes', [DisputeController::class, 'store']);
        Route::get('/disputes', [DisputeController::class, 'index']);
        Route::get('/disputes/{dispute}', [DisputeController::class, 'show']);

        // Admin routes
        Route::middleware('role:admin')->prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard']);
            Route::get('/users', [AdminController::class, 'users']);
            Route::put('/users/{user}/verify', [AdminController::class, 'verifyUser']);
            Route::put('/users/{user}/ban', [AdminController::class, 'banUser']);
            Route::put('/users/{user}/unban', [AdminController::class, 'unbanUser']);
            Route::put('/users/{user}/suspend', [AdminController::class, 'suspendUser']);
            Route::put('/users/{user}/unsuspend', [AdminController::class, 'unsuspendUser']);
            Route::get('/kyc/pending', [AdminController::class, 'pendingKyc']);
            Route::put('/kyc/{document}/approve', [AdminController::class, 'approveKyc']);
            Route::put('/kyc/{document}/reject', [AdminController::class, 'rejectKyc']);
            Route::get('/reports', [AdminController::class, 'reports']);
            Route::put('/reports/{report}/resolve', [AdminController::class, 'resolveReport']);
            Route::put('/reports/{report}/dismiss', [AdminController::class, 'dismissReport']);
            Route::get('/tasks/pending', [AdminController::class, 'pendingTasks']);
            Route::get('/disputes/pending', [AdminController::class, 'pendingDisputes']);
            Route::put('/disputes/{dispute}/resolve', [AdminController::class, 'resolveDispute']);
            Route::get('/payments/overview', [AdminController::class, 'paymentsOverview']);
            Route::get('/commissions', [AdminController::class, 'commissions']);
        });
    });

    Route::middleware(['jwt', 'throttle:30,1'])->prefix('messaging')->group(function () {
        Route::post('/send', [RealtimeMessageController::class, 'send']);
        Route::get('/history', [RealtimeMessageController::class, 'history']);
        Route::post('/typing', [RealtimeMessageController::class, 'typing']);
        Route::post('/read', [RealtimeMessageController::class, 'read']);
    });
});
