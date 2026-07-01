<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dispute;
use App\Models\Task;
use Illuminate\Http\Request;

class DisputeController extends Controller
{
    /**
     * Get disputes for authenticated user
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Dispute::where(function ($q) use ($user) {
            $q->where('complainant_id', $user->id)
                ->orWhere('respondent_id', $user->id);
        })->with(['task:id,title_fr,title_ar', 'complainant:id,name,avatar', 'respondent:id,name,avatar']);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $disputes = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $disputes,
            'message' => 'Disputes retrieved successfully',
        ]);
    }

    /**
     * Get dispute details
     */
    public function show(Request $request, $disputeId)
    {
        $dispute = Dispute::with([
            'task:id,title_fr,title_ar,user_id',
            'complainant:id,name,avatar',
            'respondent:id,name,avatar',
        ])->find($disputeId);

        if (! $dispute) {
            return response()->json([
                'success' => false,
                'message' => 'Dispute not found',
            ], 404);
        }

        $user = $request->user();

        // Check if user is involved in this dispute
        if ($dispute->complainant_id !== $user->id && $dispute->respondent_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to view this dispute',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $dispute,
            'message' => 'Dispute details retrieved successfully',
        ]);
    }

    /**
     * Create a new dispute
     */
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'respondent_id' => 'required|exists:users,id',
            'type' => 'required|in:payment,quality,communication,other',
            'title_fr' => 'required_without:title_ar|string|max:255',
            'title_ar' => 'required_without:title_fr|string|max:255',
            'description_fr' => 'required_without:description_ar|string|max:2000',
            'description_ar' => 'required_without:description_fr|string|max:2000',
            'evidence' => 'sometimes|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:10240',
        ]);

        $task = Task::find($taskId);

        if (! $task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $user = $request->user();
        $respondentId = $request->respondent_id;

        // Check if user is involved in this task
        $isTaskOwner = $task->user_id === $user->id;
        $isTaskWorker = $task->taskApplications()->where('user_id', $user->id)->where('status', 'accepted')->exists();

        if (! $isTaskOwner && ! $isTaskWorker) {
            return response()->json([
                'success' => false,
                'message' => 'You are not involved in this task',
            ], 403);
        }

        // Check if respondent is involved in this task
        $respondentIsOwner = $task->user_id === $respondentId;
        $respondentIsWorker = $task->taskApplications()->where('user_id', $respondentId)->where('status', 'accepted')->exists();

        if (! $respondentIsOwner && ! $respondentIsWorker) {
            return response()->json([
                'success' => false,
                'message' => 'Respondent is not involved in this task',
            ], 400);
        }

        // Cannot dispute against yourself
        if ($user->id === $respondentId) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot create a dispute against yourself',
            ], 400);
        }

        // Check if dispute already exists for this task between these users
        $existingDispute = Dispute::where('task_id', $taskId)
            ->where(function ($query) use ($user, $respondentId) {
                $query->where(function ($q) use ($user, $respondentId) {
                    $q->where('complainant_id', $user->id)
                        ->where('respondent_id', $respondentId);
                })->orWhere(function ($q) use ($user, $respondentId) {
                    $q->where('complainant_id', $respondentId)
                        ->where('respondent_id', $user->id);
                });
            })
            ->whereIn('status', ['open', 'in_progress'])
            ->first();

        if ($existingDispute) {
            return response()->json([
                'success' => false,
                'message' => 'An active dispute already exists between you and this user for this task',
            ], 400);
        }

        $disputeData = [
            'task_id' => $taskId,
            'complainant_id' => $user->id,
            'respondent_id' => $respondentId,
            'type' => $request->type,
            'title_fr' => $request->title_fr,
            'title_ar' => $request->title_ar,
            'description_fr' => $request->description_fr,
            'description_ar' => $request->description_ar,
            'status' => 'open',
        ];

        // Handle evidence file upload
        if ($request->hasFile('evidence')) {
            $evidencePath = $request->file('evidence')->store('dispute_evidence', 'public');
            $disputeData['evidence'] = $evidencePath;
        }

        $dispute = Dispute::create($disputeData);
        $dispute->load(['task', 'complainant', 'respondent']);

        return response()->json([
            'success' => true,
            'data' => $dispute,
            'message' => 'Dispute created successfully',
        ], 201);
    }

    /**
     * Update dispute status (admin only)
     */
    public function updateStatus(Request $request, $disputeId)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
            'admin_notes' => 'sometimes|string|max:1000',
        ]);

        $dispute = Dispute::find($disputeId);

        if (! $dispute) {
            return response()->json([
                'success' => false,
                'message' => 'Dispute not found',
            ], 404);
        }

        $user = $request->user();

        // Only admin can update dispute status
        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Only administrators can update dispute status',
            ], 403);
        }

        $dispute->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'resolved_at' => in_array($request->status, ['resolved', 'closed']) ? now() : null,
        ]);

        return response()->json([
            'success' => true,
            'data' => $dispute->fresh(['task', 'complainant', 'respondent']),
            'message' => 'Dispute status updated successfully',
        ]);
    }

    /**
     * Add response to dispute
     */
    public function addResponse(Request $request, $disputeId)
    {
        $request->validate([
            'response_fr' => 'required_without:response_ar|string|max:2000',
            'response_ar' => 'required_without:response_fr|string|max:2000',
        ]);

        $dispute = Dispute::find($disputeId);

        if (! $dispute) {
            return response()->json([
                'success' => false,
                'message' => 'Dispute not found',
            ], 404);
        }

        $user = $request->user();

        // Only respondent can add response
        if ($dispute->respondent_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Only the respondent can add a response to this dispute',
            ], 403);
        }

        if ($dispute->status !== 'open') {
            return response()->json([
                'success' => false,
                'message' => 'Can only respond to open disputes',
            ], 400);
        }

        $dispute->update([
            'response_fr' => $request->response_fr,
            'response_ar' => $request->response_ar,
            'status' => 'in_progress',
            'responded_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $dispute->fresh(['task', 'complainant', 'respondent']),
            'message' => 'Response added successfully',
        ]);
    }

    /**
     * Get dispute statistics (admin only)
     */
    public function stats(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Only administrators can view dispute statistics',
            ], 403);
        }

        $stats = [
            'total_disputes' => Dispute::count(),
            'open_disputes' => Dispute::where('status', 'open')->count(),
            'in_progress_disputes' => Dispute::where('status', 'in_progress')->count(),
            'resolved_disputes' => Dispute::where('status', 'resolved')->count(),
            'closed_disputes' => Dispute::where('status', 'closed')->count(),
            'disputes_by_type' => [
                'payment' => Dispute::where('type', 'payment')->count(),
                'quality' => Dispute::where('type', 'quality')->count(),
                'communication' => Dispute::where('type', 'communication')->count(),
                'other' => Dispute::where('type', 'other')->count(),
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Dispute statistics retrieved successfully',
        ]);
    }
}
