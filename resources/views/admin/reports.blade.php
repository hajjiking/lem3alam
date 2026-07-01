@extends('admin.layouts.app')

@section('title', 'Reports')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-chart-bar fa-lg"></i> Reports & Analytics
                </h1>
                <div>
                    <button class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Report
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalUsers) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Tasks</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalTasks) }}</div>
                            <div class="text-xs text-muted">{{ number_format($completedTasks) }} completed</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRevenue, 2) }} MAD</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Disputes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalDisputes) }}</div>
                            <div class="text-xs text-muted">{{ number_format($resolvedDisputes) }} resolved</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Monthly Users Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly User Registrations</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyUsersChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Revenue</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyRevenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribution Charts -->
    <div class="row mb-4">
        <!-- User Role Distribution -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Role Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="userRoleChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Task Status Distribution -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Task Status Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="taskStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Categories Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Performing Categories</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Total Tasks</th>
                                    <th>Average Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topCategories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ number_format($category->task_count) }}</td>
                                    <td>${{ number_format($category->avg_budget, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@php($monthlyUsersLabels = $monthlyUsers->pluck('month')->map(fn ($month) => date('M', mktime(0, 0, 0, $month, 1)))->values())
@php($monthlyUsersCounts = $monthlyUsers->pluck('count')->values())
@php($monthlyRevenueLabels = $monthlyRevenue->pluck('month')->map(fn ($month) => date('M', mktime(0, 0, 0, $month, 1)))->values())
@php($monthlyRevenueTotals = $monthlyRevenue->pluck('total')->values())
@php($usersByRoleLabels = $usersByRole->pluck('role')->values())
@php($usersByRoleCounts = $usersByRole->pluck('count')->values())
@php($tasksByStatusLabels = $tasksByStatus->pluck('status')->values())
@php($tasksByStatusCounts = $tasksByStatus->pluck('count')->values())
<script type="application/json" id="adminMonthlyUsersLabels">@json($monthlyUsersLabels)</script>
<script type="application/json" id="adminMonthlyUsersCounts">@json($monthlyUsersCounts)</script>
<script type="application/json" id="adminMonthlyRevenueLabels">@json($monthlyRevenueLabels)</script>
<script type="application/json" id="adminMonthlyRevenueTotals">@json($monthlyRevenueTotals)</script>
<script type="application/json" id="adminUsersByRoleLabels">@json($usersByRoleLabels)</script>
<script type="application/json" id="adminUsersByRoleCounts">@json($usersByRoleCounts)</script>
<script type="application/json" id="adminTasksByStatusLabels">@json($tasksByStatusLabels)</script>
<script type="application/json" id="adminTasksByStatusCounts">@json($tasksByStatusCounts)</script>
<script>
const themeTokens = (window.__lem3alamTheme && window.__lem3alamTheme.get) ? window.__lem3alamTheme.get() : { muted: '#475569', grid: 'rgba(148,163,184,0.35)' };
const getJson = (id, fallback) => {
    const el = document.getElementById(id);
    if (!el) return fallback;
    try {
        return JSON.parse(el.textContent || '');
    } catch (_) {
        return fallback;
    }
};
const monthlyUsersLabels = getJson('adminMonthlyUsersLabels', []);
const monthlyUsersCounts = getJson('adminMonthlyUsersCounts', []);
const monthlyRevenueLabels = getJson('adminMonthlyRevenueLabels', []);
const monthlyRevenueTotals = getJson('adminMonthlyRevenueTotals', []);
const usersByRoleLabels = getJson('adminUsersByRoleLabels', []);
const usersByRoleCounts = getJson('adminUsersByRoleCounts', []);
const tasksByStatusLabels = getJson('adminTasksByStatusLabels', []);
const tasksByStatusCounts = getJson('adminTasksByStatusCounts', []);

// Monthly Users Chart
const monthlyUsersCtx = document.getElementById('monthlyUsersChart').getContext('2d');
const monthlyUsersChart = new Chart(monthlyUsersCtx, {
    type: 'line',
    data: {
        labels: monthlyUsersLabels,
        datasets: [{
            label: 'New Users',
            data: monthlyUsersCounts,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: themeTokens.muted } }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: themeTokens.muted },
                grid: { color: themeTokens.grid }
            },
            x: {
                ticks: { color: themeTokens.muted },
                grid: { color: themeTokens.grid }
            }
        }
    }
});

// Monthly Revenue Chart
const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
const monthlyRevenueChart = new Chart(monthlyRevenueCtx, {
    type: 'bar',
    data: {
        labels: monthlyRevenueLabels,
        datasets: [{
            label: 'Revenue ($)',
            data: monthlyRevenueTotals,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: themeTokens.muted } }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: themeTokens.muted },
                grid: { color: themeTokens.grid }
            },
            x: {
                ticks: { color: themeTokens.muted },
                grid: { color: themeTokens.grid }
            }
        }
    }
});

// User Role Distribution Chart
const userRoleCtx = document.getElementById('userRoleChart').getContext('2d');
const userRoleChart = new Chart(userRoleCtx, {
    type: 'doughnut',
    data: {
        labels: usersByRoleLabels,
        datasets: [{
            data: usersByRoleCounts,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: themeTokens.muted } }
        }
    }
});

// Task Status Distribution Chart
const taskStatusCtx = document.getElementById('taskStatusChart').getContext('2d');
const taskStatusChart = new Chart(taskStatusCtx, {
    type: 'pie',
    data: {
        labels: tasksByStatusLabels,
        datasets: [{
            data: tasksByStatusCounts,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: themeTokens.muted } }
        }
    }
});

document.addEventListener('app:theme-changed', (e) => {
    const t = (e && e.detail) ? e.detail : themeTokens;

    monthlyUsersChart.options.plugins.legend.labels.color = t.muted;
    monthlyUsersChart.options.scales.x.ticks.color = t.muted;
    monthlyUsersChart.options.scales.y.ticks.color = t.muted;
    monthlyUsersChart.options.scales.x.grid.color = t.grid;
    monthlyUsersChart.options.scales.y.grid.color = t.grid;
    monthlyUsersChart.update();

    monthlyRevenueChart.options.plugins.legend.labels.color = t.muted;
    monthlyRevenueChart.options.scales.x.ticks.color = t.muted;
    monthlyRevenueChart.options.scales.y.ticks.color = t.muted;
    monthlyRevenueChart.options.scales.x.grid.color = t.grid;
    monthlyRevenueChart.options.scales.y.grid.color = t.grid;
    monthlyRevenueChart.update();

    userRoleChart.options.plugins.legend.labels.color = t.muted;
    userRoleChart.update();

    taskStatusChart.options.plugins.legend.labels.color = t.muted;
    taskStatusChart.update();
});
</script>
@endpush
@endsection
