<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class TaskerController extends Controller
{
    public function show(User $user)
    {
        if (! $user->isTasker()) {
            return response()->json([
                'success' => false,
                'message' => 'Tasker not found',
            ], 404);
        }

        $user->load([
            'verifiedSkills',
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
    }

    public function reviews(Request $request, User $user)
    {
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
    }
}

