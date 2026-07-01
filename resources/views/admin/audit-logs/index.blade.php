@extends('admin.layouts.app')

@section('title', 'Audit Logs')
@section('page-title', 'Audit Logs')

@section('content')
<div class="ui-card">
    <div class="ui-card-body">
        <form method="GET" action="{{ route('admin.audit-logs.index') }}" class="grid gap-3 md:grid-cols-12">
            <div class="md:col-span-4">
                <label class="ui-label" for="q">Search</label>
                <input id="q" name="q" value="{{ $filters['q'] ?? '' }}" class="ui-input" placeholder="Action, admin, IP...">
            </div>
            <div class="md:col-span-3">
                <label class="ui-label" for="action">Action</label>
                <select id="action" name="action" class="ui-input">
                    <option value="">All</option>
                    @foreach($actions as $a)
                        <option value="{{ $a }}" @selected(($filters['action'] ?? '') === $a)>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="from">From</label>
                <input id="from" name="from" type="date" value="{{ $filters['from'] ?? '' }}" class="ui-input">
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="to">To</label>
                <input id="to" name="to" type="date" value="{{ $filters['to'] ?? '' }}" class="ui-input">
            </div>
            <div class="md:col-span-1 flex items-end">
                <button class="ui-btn ui-btn-primary w-full" type="submit">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="mt-4 ui-card">
    <div class="ui-card-body">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-xs font-extrabold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="py-3 pe-4">Time</th>
                        <th class="py-3 pe-4">Admin</th>
                        <th class="py-3 pe-4">Action</th>
                        <th class="py-3 pe-4">Target</th>
                        <th class="py-3 pe-4">IP</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/70 dark:divide-slate-800/70">
                    @forelse($logs as $log)
                        <tr>
                            <td class="py-3 pe-4 whitespace-nowrap text-slate-600 dark:text-slate-300">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                            <td class="py-3 pe-4">
                                <div class="font-semibold">{{ $log->actor?->name ?? 'N/A' }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $log->actor?->email ?? '' }}</div>
                            </td>
                            <td class="py-3 pe-4">
                                <div class="font-semibold">{{ $log->action }}</div>
                            </td>
                            <td class="py-3 pe-4 text-slate-600 dark:text-slate-300">
                                @if($log->target_type && $log->target_id)
                                    <div class="font-semibold">{{ class_basename($log->target_type) }} #{{ $log->target_id }}</div>
                                @else
                                    <div class="text-slate-400">—</div>
                                @endif
                            </td>
                            <td class="py-3 pe-4 text-slate-600 dark:text-slate-300">{{ $log->ip }}</td>
                            <td class="py-3">
                                @php($status = (int) data_get($log->metadata, 'status'))
                                @if($status >= 200 && $status < 300)
                                    <span class="ui-badge border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-200">{{ $status }}</span>
                                @elseif($status >= 400)
                                    <span class="ui-badge border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-200">{{ $status }}</span>
                                @else
                                    <span class="ui-badge">{{ $status ?: '—' }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-500 dark:text-slate-400">No audit logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection

