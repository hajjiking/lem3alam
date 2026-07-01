<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\UserReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function mine(Request $request)
    {
        $reports = UserReport::where('reporter_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate($request->get('per_page', 20));

        return response()->json(['success' => true, 'data' => $reports]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reported_user_id' => 'nullable|exists:users,id',
            'task_id' => 'nullable|exists:tasks,id',
            'message_id' => 'nullable|exists:messages,id',
            'reason' => 'required|string|max:255',
            'details' => 'nullable|string|max:5000',
        ]);

        if (
            empty($data['reported_user_id']) &&
            empty($data['task_id']) &&
            empty($data['message_id'])
        ) {
            return response()->json([
                'success' => false,
                'message' => 'You must report a user, task, or message.',
            ], 422);
        }

        $report = UserReport::create([
            'reporter_id' => $request->user()->id,
            'reported_user_id' => $data['reported_user_id'] ?? null,
            'task_id' => $data['task_id'] ?? null,
            'message_id' => $data['message_id'] ?? null,
            'reason' => $data['reason'],
            'details' => $data['details'] ?? null,
            'status' => 'open',
        ]);

        AuditLog::create([
            'actor_id' => $request->user()->id,
            'action' => 'report.created',
            'target_type' => 'user_report',
            'target_id' => $report->id,
            'metadata' => [
                'reported_user_id' => $report->reported_user_id,
                'task_id' => $report->task_id,
                'message_id' => $report->message_id,
                'reason' => $report->reason,
            ],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Report submitted successfully.',
            'data' => $report,
        ]);
    }
}
