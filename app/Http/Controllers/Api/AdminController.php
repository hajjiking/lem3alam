<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Dispute;
use App\Models\KycDocument;
use App\Models\Payment;
use App\Models\Task;
use App\Models\User;
use App\Models\UserReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'users_count' => User::count(),
                'tasks_count' => Task::count(),
                'disputes_count' => Dispute::where('status', 'open')->count(),
                'revenue' => Payment::sum('amount'),
            ],
        ]);
    }

    public function users(Request $request)
    {
        $users = User::paginate($request->get('per_page', 20));

        return response()->json(['success' => true, 'data' => $users]);
    }

    public function verifyUser(User $user)
    {
        $user->update(['is_verified' => true]);

        return response()->json(['success' => true, 'message' => 'User verified successfully']);
    }

    public function pendingKyc(Request $request)
    {
        $docs = KycDocument::where('status', 'pending')
            ->orderBy('submitted_at')
            ->paginate($request->get('per_page', 20));

        return response()->json(['success' => true, 'data' => $docs]);
    }

    public function approveKyc(Request $request, KycDocument $document)
    {
        $document->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        $document->user->update([
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'kyc.approved',
            'target_type' => 'kyc_document',
            'target_id' => $document->id,
            'metadata' => ['user_id' => $document->user_id],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'KYC document approved.']);
    }

    public function rejectKyc(Request $request, KycDocument $document)
    {
        $data = $request->validate([
            'reason' => 'required|string|max:2000',
        ]);

        $document->update([
            'status' => 'rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => $data['reason'],
        ]);

        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'kyc.rejected',
            'target_type' => 'kyc_document',
            'target_id' => $document->id,
            'metadata' => ['user_id' => $document->user_id],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'KYC document rejected.']);
    }

    public function reports(Request $request)
    {
        $reports = UserReport::orderByDesc('created_at')->paginate($request->get('per_page', 20));

        return response()->json(['success' => true, 'data' => $reports]);
    }

    public function resolveReport(Request $request, UserReport $report)
    {
        $data = $request->validate([
            'resolution_notes' => 'nullable|string|max:5000',
        ]);

        $report->update([
            'status' => 'resolved',
            'handled_by' => Auth::id(),
            'handled_at' => now(),
            'resolution_notes' => $data['resolution_notes'] ?? null,
        ]);

        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'report.resolved',
            'target_type' => 'user_report',
            'target_id' => $report->id,
            'metadata' => ['status' => 'resolved'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'Report resolved.']);
    }

    public function dismissReport(Request $request, UserReport $report)
    {
        $data = $request->validate([
            'resolution_notes' => 'nullable|string|max:5000',
        ]);

        $report->update([
            'status' => 'dismissed',
            'handled_by' => Auth::id(),
            'handled_at' => now(),
            'resolution_notes' => $data['resolution_notes'] ?? null,
        ]);

        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'report.dismissed',
            'target_type' => 'user_report',
            'target_id' => $report->id,
            'metadata' => ['status' => 'dismissed'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'Report dismissed.']);
    }

    public function banUser(Request $request, User $user)
    {
        $data = $request->validate([
            'reason' => 'nullable|string|max:255',
        ]);

        $user->update([
            'banned_at' => now(),
            'ban_reason' => $data['reason'] ?? null,
            'status' => 'inactive',
            'suspended_until' => null,
        ]);

        $user->tokens()->delete();

        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'user.banned',
            'target_type' => 'user',
            'target_id' => $user->id,
            'metadata' => ['reason' => $data['reason'] ?? null],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'User banned.']);
    }

    public function unbanUser(Request $request, User $user)
    {
        $user->update([
            'banned_at' => null,
            'ban_reason' => null,
            'status' => 'active',
        ]);

        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'user.unbanned',
            'target_type' => 'user',
            'target_id' => $user->id,
            'metadata' => null,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'User unbanned.']);
    }

    public function suspendUser(Request $request, User $user)
    {
        $data = $request->validate([
            'days' => 'nullable|integer|min:1|max:365',
            'until' => 'nullable|date|after:now',
            'reason' => 'nullable|string|max:255',
        ]);

        $until = null;
        if (! empty($data['until'])) {
            $until = $data['until'];
        } elseif (! empty($data['days'])) {
            $until = now()->addDays((int) $data['days']);
        } else {
            $until = now()->addDays(7);
        }

        $user->update([
            'status' => 'suspended',
            'suspended_until' => $until,
            'ban_reason' => $data['reason'] ?? $user->ban_reason,
        ]);

        $user->tokens()->delete();

        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'user.suspended',
            'target_type' => 'user',
            'target_id' => $user->id,
            'metadata' => ['until' => $until, 'reason' => $data['reason'] ?? null],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'User suspended.']);
    }

    public function unsuspendUser(Request $request, User $user)
    {
        $user->update([
            'status' => 'active',
            'suspended_until' => null,
        ]);

        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'user.unsuspended',
            'target_type' => 'user',
            'target_id' => $user->id,
            'metadata' => null,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'User unsuspended.']);
    }

    public function pendingTasks()
    {
        $tasks = Task::where('status', 'open')->paginate(20);

        return response()->json(['success' => true, 'data' => $tasks]);
    }

    public function pendingDisputes()
    {
        $disputes = Dispute::where('status', 'open')->paginate(20);

        return response()->json(['success' => true, 'data' => $disputes]);
    }

    public function resolveDispute(Request $request, Dispute $dispute)
    {
        $request->validate(['resolution' => 'required|string']);
        $dispute->update(['status' => 'resolved', 'resolution' => $request->resolution]);

        return response()->json(['success' => true, 'message' => 'Dispute resolved']);
    }

    public function paymentsOverview()
    {
        $payments = Payment::latest()->paginate(20);

        return response()->json(['success' => true, 'data' => $payments]);
    }

    public function commissions()
    {
        // Placeholder for commission logic
        return response()->json(['success' => true, 'data' => []]);
    }
}
