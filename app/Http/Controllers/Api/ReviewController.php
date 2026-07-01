<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Task;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Get reviews for a specific task
     */
    public function index(Request $request, $taskId)
    {
        $task = Task::find($taskId);

        if (! $task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $reviews = Review::where('task_id', $taskId)
            ->with(['reviewer:id,name,avatar', 'reviewee:id,name,avatar'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $reviews,
            'message' => 'Reviews retrieved successfully',
        ]);
    }

    /**
     * Get reviews for a specific user
     */
    public function userReviews(Request $request, $userId)
    {
        $reviews = Review::where('reviewee_id', $userId)
            ->with(['reviewer:id,name,avatar', 'task:id,title_fr,title_ar'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 10));

        $averageRating = Review::where('reviewee_id', $userId)->avg('rating') ?? 0;
        $totalReviews = Review::where('reviewee_id', $userId)->count();

        return response()->json([
            'success' => true,
            'data' => [
                'reviews' => $reviews,
                'average_rating' => round($averageRating, 2),
                'total_reviews' => $totalReviews,
            ],
            'message' => 'User reviews retrieved successfully',
        ]);
    }

    /**
     * Create a new review
     */
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'reviewee_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment_fr' => 'required_without:comment_ar|string|max:1000',
            'comment_ar' => 'required_without:comment_fr|string|max:1000',
        ]);

        $task = Task::find($taskId);

        if (! $task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $user = $request->user();
        $revieweeId = $request->reviewee_id;

        // Check if task is completed
        if ($task->status !== 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Can only review completed tasks',
            ], 400);
        }

        // Check if user is involved in this task
        $isTaskOwner = $task->user_id === $user->id;
        $isTaskWorker = $task->taskApplications()->where('user_id', $user->id)->where('status', 'accepted')->exists();

        if (! $isTaskOwner && ! $isTaskWorker) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to review this task',
            ], 403);
        }

        // Check if reviewee is involved in this task
        $revieweeIsOwner = $task->user_id === $revieweeId;
        $revieweeIsWorker = $task->taskApplications()->where('user_id', $revieweeId)->where('status', 'accepted')->exists();

        if (! $revieweeIsOwner && ! $revieweeIsWorker) {
            return response()->json([
                'success' => false,
                'message' => 'Reviewee is not involved in this task',
            ], 400);
        }

        // Check if user already reviewed this person for this task
        $existingReview = Review::where('task_id', $taskId)
            ->where('reviewer_id', $user->id)
            ->where('reviewee_id', $revieweeId)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this person for this task',
            ], 400);
        }

        // Cannot review yourself
        if ($user->id === $revieweeId) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot review yourself',
            ], 400);
        }

        $review = Review::create([
            'task_id' => $taskId,
            'reviewer_id' => $user->id,
            'reviewee_id' => $revieweeId,
            'rating' => $request->rating,
            'comment_fr' => $request->comment_fr,
            'comment_ar' => $request->comment_ar,
        ]);

        $review->load(['reviewer:id,name,avatar', 'reviewee:id,name,avatar', 'task:id,title_fr,title_ar']);

        return response()->json([
            'success' => true,
            'data' => $review,
            'message' => 'Review created successfully',
        ], 201);
    }

    /**
     * Update a review
     */
    public function update(Request $request, $reviewId)
    {
        $request->validate([
            'rating' => 'sometimes|integer|min:1|max:5',
            'comment_fr' => 'sometimes|string|max:1000',
            'comment_ar' => 'sometimes|string|max:1000',
        ]);

        $review = Review::find($reviewId);

        if (! $review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found',
            ], 404);
        }

        $user = $request->user();

        if ($review->reviewer_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only update your own reviews',
            ], 403);
        }

        $review->update($request->only(['rating', 'comment_fr', 'comment_ar']));
        $review->load(['reviewer:id,name,avatar', 'reviewee:id,name,avatar', 'task:id,title_fr,title_ar']);

        return response()->json([
            'success' => true,
            'data' => $review,
            'message' => 'Review updated successfully',
        ]);
    }

    /**
     * Delete a review
     */
    public function destroy(Request $request, $reviewId)
    {
        $review = Review::find($reviewId);

        if (! $review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found',
            ], 404);
        }

        $user = $request->user();

        if ($review->reviewer_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only delete your own reviews',
            ], 403);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully',
        ]);
    }
}
