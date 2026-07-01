<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'admin.timeout', 'admin.permission:view_audit_logs']);
    }

    public function index(Request $request)
    {
        $query = AuditLog::query()->with('actor')->latest('id');

        $q = trim((string) $request->query('q', ''));
        if ($q !== '') {
            $query->where(function ($inner) use ($q) {
                $inner->where('action', 'like', '%'.$q.'%')
                    ->orWhere('ip', 'like', '%'.$q.'%')
                    ->orWhereHas('actor', function ($actor) use ($q) {
                        $actor->where('email', 'like', '%'.$q.'%')
                            ->orWhere('name', 'like', '%'.$q.'%');
                    });
            });
        }

        $action = trim((string) $request->query('action', ''));
        if ($action !== '') {
            $query->where('action', $action);
        }

        $actorId = $request->query('actor_id');
        if ($actorId !== null && $actorId !== '') {
            $query->where('actor_id', (int) $actorId);
        }

        $from = $request->query('from');
        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }

        $to = $request->query('to');
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        $logs = $query->paginate(20)->withQueryString();

        $actions = AuditLog::query()
            ->select('action')
            ->distinct()
            ->orderBy('action')
            ->limit(200)
            ->pluck('action');

        return view('admin.audit-logs.index', [
            'logs' => $logs,
            'actions' => $actions,
            'filters' => [
                'q' => $q,
                'action' => $action,
                'actor_id' => $actorId,
                'from' => $from,
                'to' => $to,
            ],
        ]);
    }
}

