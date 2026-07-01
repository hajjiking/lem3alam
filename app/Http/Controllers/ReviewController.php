<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display reviews for a specific tasker
     */
    public function index($locale, $tasker)
    {
        $tasker = User::findOrFail($tasker);

        $reviews = \App\Models\Review::approved()
            ->where(function ($q) use ($tasker) {
                $q->where('tasker_id', $tasker->id)
                    ->orWhere('reviewee_id', $tasker->id);
            })
            ->with(['client', 'task'])
            ->latest()
            ->paginate(10);

        $stats = [
            'average_rating' => $tasker->getAverageRating(),
            'total_reviews' => $tasker->getTotalReviews(),
            'rating_breakdown' => $tasker->getRatingBreakdown(),
        ];

        return view('reviews.index', compact('reviews', 'tasker', 'stats'));
    }

    /**
     * Show the form for creating a new review
     */
    public function create($locale, $tasker, $task = null)
    {
        // Check if user is authenticated and is a client
        if (! Auth::check() || Auth::user()->role !== 'client') {
            abort(403, 'Only clients can leave reviews');
        }

        // Resolve models with graceful fallbacks
        $taskId = $task ? (int) $task : null;
        $taskModel = $taskId ? Task::find($taskId) : null;
        $canSubmit = true;
        $errorMessage = null;
        if ($taskId && ! $taskModel) {
            $canSubmit = false;
            $errorMessage = __('Task not found');
        }
        $taskerId = (int) $tasker;
        $taskerModel = User::find($taskerId);
        if (! $taskerModel && $taskModel && $taskModel->assigned_tasker_id) {
            $taskerModel = User::find($taskModel->assigned_tasker_id);
        }
        if (! $taskerModel) {
            $canSubmit = false;
            $errorMessage = $taskModel ? __('Selected tasker not found for this task') : __('Tasker not found');
        }

        // Basic consistency checks when a task is provided
        if ($taskModel) {
            if ($taskModel->client_id !== Auth::id()) {
                $canSubmit = false;
                $errorMessage = __('You can only review tasks you own');
            }
            // Always prefer the task's assigned tasker when available
            if ($taskModel->assigned_tasker_id) {
                $assigned = User::find($taskModel->assigned_tasker_id);
                if ($assigned) {
                    $taskerModel = $assigned;
                }
            }
            if ($taskModel->status !== 'completed') {
                $canSubmit = false;
                $errorMessage = __('Task must be completed before reviewing');
            }
        }

        // Check if client has already reviewed this tasker for this task
        $existingReview = null;
        if ($taskModel && $taskerModel && $taskerModel->hasReviewFromClient(Auth::id(), $taskModel->id)) {
            $existing = Review::where('client_id', Auth::id())
                ->where('tasker_id', $taskerModel->id)
                ->where('task_id', $taskModel->id)
                ->first();
            if ($existing) {
                $canSubmit = false;
                $errorMessage = __('You have already reviewed this tasker for this task.');
                $existingReview = $existing;
            }
        }

        $tasker = $taskerModel;
        $task = $taskModel;

        return view('reviews.create', compact('tasker', 'task', 'canSubmit', 'errorMessage', 'existingReview'));
    }

    /**
     * Store a newly created review
     */
    public function store(Request $request, $locale, $tasker)
    {
        $tasker = User::findOrFail($tasker);

        // Check if user is authenticated and is a client
        if (! Auth::check() || Auth::user()->role !== 'client') {
            abort(403, 'Only clients can leave reviews');
        }

        Log::info('Review store attempt', [
            'client_id' => Auth::id(),
            'tasker_id' => $tasker->id,
            'payload' => $request->except(['_token']),
            'locale' => $locale,
        ]);

        $validator = Validator::make($request->all(), [
            'quality_rating' => 'required|numeric|min:1|max:5',
            'communication_rating' => 'required|numeric|min:1|max:5',
            'timeliness_rating' => 'required|numeric|min:1|max:5',
            'professionalism_rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|min:20|max:500',
            'comment_ar' => 'nullable|string|max:500',
            'task_id' => 'nullable|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            Log::warning('Review store validation failed', [
                'client_id' => Auth::id(),
                'errors' => $validator->errors()->toArray(),
            ]);

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $blocked = ['badword1', 'badword2', 'offensive'];
        $commentAll = strtolower($request->comment.' '.($request->comment_ar ?? ''));
        foreach ($blocked as $w) {
            if (str_contains($commentAll, $w)) {
                return redirect()->back()->with('error', __('Inappropriate content in review'));
            }
        }

        // Eligibility checks when a task is provided
        $taskId = $request->task_id;
        if ($taskId) {
            $taskModel = Task::find($taskId);
            if (! $taskModel) {
                return redirect()->back()->with('error', __('Task not found'));
            }
            if ($taskModel->client_id !== Auth::id()) {
                return redirect()->back()->with('error', __('You can only review tasks you own'));
            }
            if ($tasker->hasReviewFromClient(Auth::id(), $taskId)) {
                return redirect()->back()->with('error', 'You have already reviewed this tasker for this task.');
            }
        }

        $overall = round((
            (float) $request->quality_rating +
            (float) $request->communication_rating +
            (float) $request->timeliness_rating +
            (float) $request->professionalism_rating
        ) / 4);

        // Create the review transactionally
        try {
            DB::beginTransaction();

            $review = Review::create([
                'client_id' => Auth::id(),
                'tasker_id' => $tasker->id,
                'task_id' => $taskId,
                'rating' => $overall,
                'comment' => $request->comment,
                'comment_translations' => [
                    'fr' => $request->comment,
                    'ar' => $request->comment_ar ?? $request->comment,
                ],
                // Auto-approve immediately
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => Auth::id(), // Auto-approved by system/creator logic

                'metadata' => [
                    'client_ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'criteria' => [
                        'quality' => (float) $request->quality_rating,
                        'communication' => (float) $request->communication_rating,
                        'timeliness' => (float) $request->timeliness_rating,
                        'professionalism' => (float) $request->professionalism_rating,
                    ],
                ],
                'reviewer_id' => Auth::id(),
                'reviewee_id' => $tasker->id,
                'type' => 'task',
            ]);

            // Update tasker's rating stats
            $tasker->updateRatingStats();

            DB::commit();

            Log::info('Review stored and approved successfully', [
                'review_id' => $review->id,
                'tasker_id' => $tasker->id,
            ]);

            try {
                if ($tasker->email) {
                    \Illuminate\Support\Facades\Mail::raw(__('You received a new review.'), function ($m) use ($tasker) {
                        $m->to($tasker->email)->subject(__('New Review Received'));
                    });
                }
            } catch (\Throwable $e) {
                Log::warning('Failed to send review email', ['error' => $e->getMessage()]);
            }

            return redirect()->route('tasker.profile.show', ['locale' => $locale, 'id' => $tasker->id])
                ->with('success', 'Your review has been submitted and published.');

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Review store failed', [
                'client_id' => Auth::id(),
                'tasker_id' => $tasker->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', __('Failed to submit review. Please try again.'));
        }
    }

    /**
     * Display the specified review
     */
    public function show(Review $review)
    {
        if (! $review->isApproved()) {
            abort(404);
        }

        $review->load(['client', 'tasker', 'task']);

        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified review
     */
    public function edit($locale, $review)
    {
        $review = Review::findOrFail($review);

        // Check if user is authenticated and is the owner
        if (! Auth::check() || Auth::id() !== $review->client_id) {
            abort(403, 'You can only edit your own reviews');
        }

        // Check 24 hour window
        if (now()->diffInHours($review->created_at) > 24) {
            return redirect()->back()->with('error', __('Reviews can only be edited within 24 hours.'));
        }

        $review->load(['client', 'tasker', 'task']);

        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified review
     */
    public function update(Request $request, $locale, $review)
    {
        $review = Review::findOrFail($review);

        // Check auth and owner
        if (! Auth::check() || Auth::id() !== $review->client_id) {
            abort(403, 'You can only edit your own reviews');
        }

        // Check 24 hour window
        if (now()->diffInHours($review->created_at) > 24) {
            return redirect()->back()->with('error', __('Reviews can only be edited within 24 hours.'));
        }

        $validator = Validator::make($request->all(), [
            'quality_rating' => 'required|numeric|min:1|max:5',
            'communication_rating' => 'required|numeric|min:1|max:5',
            'timeliness_rating' => 'required|numeric|min:1|max:5',
            'professionalism_rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|min:20|max:500',
            'comment_ar' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check bad words
        $blocked = ['badword1', 'badword2', 'offensive'];
        $commentAll = strtolower($request->comment.' '.($request->comment_ar ?? ''));
        foreach ($blocked as $w) {
            if (str_contains($commentAll, $w)) {
                return redirect()->back()->with('error', __('Inappropriate content in review'));
            }
        }

        $overall = round((
            (float) $request->quality_rating +
            (float) $request->communication_rating +
            (float) $request->timeliness_rating +
            (float) $request->professionalism_rating
        ) / 4);

        try {
            DB::beginTransaction();

            $review->update([
                'rating' => $overall,
                'comment' => $request->comment,
                'comment_translations' => [
                    'fr' => $request->comment,
                    'ar' => $request->comment_ar ?? $request->comment,
                ],
                'metadata' => array_merge($review->metadata ?? [], [
                    'criteria' => [
                        'quality' => (float) $request->quality_rating,
                        'communication' => (float) $request->communication_rating,
                        'timeliness' => (float) $request->timeliness_rating,
                        'professionalism' => (float) $request->professionalism_rating,
                    ],
                ]),
            ]);

            // Update tasker's rating stats
            $taskerModel = \App\Models\User::find($review->tasker_id);
            if ($taskerModel) {
                $taskerModel->updateRatingStats();
            }

            DB::commit();

            return redirect()->route('reviews.show', $review)
                ->with('success', __('Review updated successfully.'));

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Review update failed', [
                'review_id' => $review->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', __('Failed to update review.'));
        }
    }

    /**
     * Remove the specified review
     */
    public function destroy($locale, $review)
    {
        $review = Review::findOrFail($review);

        // Only the client who wrote the review can delete it
        if (! Auth::check() || Auth::id() !== $review->client_id) {
            abort(403, 'You can only delete your own reviews');
        }

        if (now()->diffInHours($review->created_at) > 24) {
            return redirect()->back()->with('error', __('Reviews can only be deleted within 24 hours.'));
        }
        $tasker = \App\Models\User::find($review->tasker_id);
        $review->delete();

        // Update tasker's rating stats
        if ($tasker) {
            $tasker->updateRatingStats();
        }

        return redirect()->route('tasker.profile.show', $tasker)
            ->with('success', 'Your review has been deleted.');
    }

    /**
     * Get reviews for a tasker (AJAX)
     */
    public function getReviews($tasker, Request $request)
    {
        $tasker = User::findOrFail($tasker);

        $query = Review::approved()
            ->where(function ($q) use ($tasker) {
                $q->where('tasker_id', $tasker->id)
                    ->orWhere('reviewee_id', $tasker->id);
            })
            ->with(['client', 'task']);

        // Filter by rating if specified
        if ($request->has('rating') && $request->rating !== 'all') {
            $query->where('rating', $request->rating);
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'highest_rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'lowest_rating':
                $query->orderBy('rating', 'asc');
                break;
            default:
                $query->latest();
        }

        $reviews = $query->paginate(5);

        return response()->json([
            'reviews' => $reviews->items(),
            'pagination' => [
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'total' => $reviews->total(),
            ],
        ]);
    }
}
