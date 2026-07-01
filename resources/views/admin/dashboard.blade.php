@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Total Users</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($totalUsers ?? 0) }}</div>
                <i class="fas fa-users text-slate-400"></i>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Clients</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($clientsCount ?? 0) }}</div>
                <i class="fas fa-user text-slate-400"></i>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Workers</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($taskersCount ?? 0) }}</div>
                <i class="fas fa-helmet-safety text-slate-400"></i>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Admins</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($adminsCount ?? 0) }}</div>
                <i class="fas fa-user-shield text-slate-400"></i>
            </div>
        </div>
    </div>

    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Total Tasks</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($totalTasks ?? 0) }}</div>
                <i class="fas fa-list-check text-slate-400"></i>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Active Tasks</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($activeTasks ?? 0) }}</div>
                <i class="fas fa-bolt text-slate-400"></i>
            </div>
            <div class="mt-3 flex flex-wrap gap-2">
                <span class="ui-badge">Open: {{ $openTasks ?? 0 }}</span>
                <span class="ui-badge">Assigned: {{ $assignedTasks ?? 0 }}</span>
                <span class="ui-badge">In progress: {{ $inProgressTasks ?? 0 }}</span>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Completed Tasks</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($completedTasks ?? 0) }}</div>
                <i class="fas fa-circle-check text-slate-400"></i>
            </div>
            <div class="mt-3 flex flex-wrap gap-2">
                <span class="ui-badge">Cancelled: {{ $cancelledTasks ?? 0 }}</span>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Revenue</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format((float) ($totalRevenue ?? 0), 2) }}</div>
                <i class="fas fa-coins text-slate-400"></i>
            </div>
            <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">MAD</div>
        </div>
    </div>

    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Categories</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($totalCategories ?? 0) }}</div>
                <i class="fas fa-layer-group text-slate-400"></i>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Reviews</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($totalReviews ?? 0) }}</div>
                <i class="fas fa-star text-slate-400"></i>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="ui-muted">Pending Disputes</div>
            <div class="mt-2 flex items-end justify-between gap-3">
                <div class="text-3xl font-extrabold tracking-tight">{{ number_format($pendingDisputes ?? 0) }}</div>
                <i class="fas fa-triangle-exclamation text-slate-400"></i>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-2">
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="mb-3 flex items-center justify-between">
                <div class="text-sm font-extrabold">User Registrations (6 months)</div>
                <span class="ui-badge">Monthly</span>
            </div>
            <div class="h-64">
                <canvas id="registrationsChart"></canvas>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="mb-3 flex items-center justify-between">
                <div class="text-sm font-extrabold">Task Creation (6 months)</div>
                <span class="ui-badge">Monthly</span>
            </div>
            <div class="h-64">
                <canvas id="tasksCreatedChart"></canvas>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="mb-3 flex items-center justify-between">
                <div class="text-sm font-extrabold">Task Completion (6 months)</div>
                <span class="ui-badge">Monthly</span>
            </div>
            <div class="h-64">
                <canvas id="tasksCompletedChart"></canvas>
            </div>
        </div>
    </div>
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="mb-3 flex items-center justify-between">
                <div class="text-sm font-extrabold">Revenue (6 months)</div>
                <span class="ui-badge">Monthly</span>
            </div>
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    <div class="ui-card lg:col-span-2">
        <div class="ui-card-body">
            <div class="mb-3 flex items-center justify-between">
                <div class="text-sm font-extrabold">User Types</div>
                <span class="ui-badge">Current</span>
            </div>
            <div class="h-72">
                <canvas id="userTypesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-2">
    <div class="ui-card">
        <div class="ui-card-body">
            <div class="mb-3 flex items-center justify-between">
                <div class="text-sm font-extrabold">Recent Tasks</div>
                @if(auth('admin')->user()?->can('manage_tasks'))
                    <a class="ui-btn ui-btn-ghost" href="{{ route('admin.tasks.index') }}">View all</a>
                @endif
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-left text-xs font-extrabold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="py-3 pe-4">Title</th>
                            <th class="py-3 pe-4">Client</th>
                            <th class="py-3 pe-4">Status</th>
                            <th class="py-3">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/70 dark:divide-slate-800/70">
                        @forelse(($recentTasks ?? collect()) as $task)
                            <tr>
                                <td class="py-3 pe-4 font-semibold">{{ \Illuminate\Support\Str::limit($task->title, 42) }}</td>
                                <td class="py-3 pe-4 text-slate-600 dark:text-slate-300">{{ $task->client?->name ?? 'N/A' }}</td>
                                <td class="py-3 pe-4">
                                    <span class="ui-badge">{{ ucfirst($task->status) }}</span>
                                </td>
                                <td class="py-3 text-slate-600 dark:text-slate-300">{{ $task->created_at?->format('M d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-500 dark:text-slate-400">No recent tasks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="ui-card">
        <div class="ui-card-body">
            <div class="mb-3 flex items-center justify-between">
                <div class="text-sm font-extrabold">Recent Users</div>
                @if(auth('admin')->user()?->can('manage_users'))
                    <a class="ui-btn ui-btn-ghost" href="{{ route('admin.users.index') }}">View all</a>
                @endif
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-left text-xs font-extrabold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="py-3 pe-4">Name</th>
                            <th class="py-3 pe-4">Email</th>
                            <th class="py-3">Role</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/70 dark:divide-slate-800/70">
                        @forelse(($recentUsers ?? collect()) as $user)
                            <tr>
                                <td class="py-3 pe-4 font-semibold">{{ $user->name }}</td>
                                <td class="py-3 pe-4 text-slate-600 dark:text-slate-300">{{ $user->email }}</td>
                                <td class="py-3"><span class="ui-badge">{{ ucfirst($user->role) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-slate-500 dark:text-slate-400">No recent users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="application/json" id="adminDashboardSeries">
@json($chartSeries ?? [])
</script>
<script type="application/json" id="adminUserTypesData">
@json([$clientsCount ?? 0, $taskersCount ?? 0, $adminsCount ?? 0])
</script>
<script>
const themeTokens = (window.__lem3alamTheme && window.__lem3alamTheme.get) ? window.__lem3alamTheme.get() : { muted: '#475569', grid: 'rgba(148,163,184,0.35)' };
const seriesEl = document.getElementById('adminDashboardSeries');
const series = seriesEl ? JSON.parse(seriesEl.textContent || '{}') : {};

function baseLineOptions() {
    return {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { labels: { color: themeTokens.muted } } },
        scales: {
            y: { beginAtZero: true, ticks: { color: themeTokens.muted }, grid: { color: themeTokens.grid } },
            x: { ticks: { color: themeTokens.muted }, grid: { color: themeTokens.grid } },
        },
    };
}

function lineChart(canvasId, label, data, color) {
    const el = document.getElementById(canvasId);
    if (!el) return null;
    return new Chart(el.getContext('2d'), {
        type: 'line',
        data: {
            labels: series.labels || [],
            datasets: [{
                label,
                data: data || [],
                borderColor: color,
                backgroundColor: color.replace('1)', '0.15)'),
                tension: 0.28,
                fill: true,
            }],
        },
        options: baseLineOptions(),
    });
}

const registrationsChart = lineChart('registrationsChart', 'Registrations', series.registrations, 'rgba(59, 130, 246, 1)');
const tasksCreatedChart = lineChart('tasksCreatedChart', 'Tasks created', series.tasks_created, 'rgba(217, 70, 239, 1)');
const tasksCompletedChart = lineChart('tasksCompletedChart', 'Tasks completed', series.tasks_completed, 'rgba(16, 185, 129, 1)');
const revenueChart = lineChart('revenueChart', 'Revenue', series.revenue, 'rgba(245, 158, 11, 1)');

const userTypesDataEl = document.getElementById('adminUserTypesData');
const userTypesData = userTypesDataEl ? JSON.parse(userTypesDataEl.textContent || '[]') : [];
const userTypesEl = document.getElementById('userTypesChart');
const userTypesChart = userTypesEl ? new Chart(userTypesEl.getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: ['Clients', 'Workers', 'Admins'],
        datasets: [{
            data: userTypesData,
            backgroundColor: ['#3B82F6', '#10B981', '#D946EF'],
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { labels: { color: themeTokens.muted } } },
    },
}) : null;

function applyTokensToLine(chart, tokens) {
    if (!chart) return;
    if (chart.options?.plugins?.legend?.labels) chart.options.plugins.legend.labels.color = tokens.muted;
    if (chart.options?.scales?.x?.ticks) chart.options.scales.x.ticks.color = tokens.muted;
    if (chart.options?.scales?.y?.ticks) chart.options.scales.y.ticks.color = tokens.muted;
    if (chart.options?.scales?.x?.grid) chart.options.scales.x.grid.color = tokens.grid;
    if (chart.options?.scales?.y?.grid) chart.options.scales.y.grid.color = tokens.grid;
    chart.update();
}

function applyTokensToLegend(chart, tokens) {
    if (!chart) return;
    if (chart.options?.plugins?.legend?.labels) chart.options.plugins.legend.labels.color = tokens.muted;
    chart.update();
}

document.addEventListener('app:theme-changed', (e) => {
    const t = (e && e.detail) ? e.detail : themeTokens;
    applyTokensToLine(registrationsChart, t);
    applyTokensToLine(tasksCreatedChart, t);
    applyTokensToLine(tasksCompletedChart, t);
    applyTokensToLine(revenueChart, t);
    applyTokensToLegend(userTypesChart, t);
});
</script>
@endpush
