@extends('admin.layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('page-actions')
<a href="{{ route('admin.users.edit', $user) }}" class="ui-btn ui-btn-primary">
    <i class="fas fa-pen"></i>
    <span>Edit</span>
</a>
<a href="{{ route('admin.users.index') }}" class="ui-btn ui-btn-secondary">
    <i class="fas fa-arrow-left"></i>
    <span>Back</span>
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
    <div class="xl:col-span-2 space-y-4">
        <div class="ui-card">
            <div class="ui-card-body">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight">{{ $user->name }}</h2>
                        <div class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $user->email }}</div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="ui-badge">{{ ucfirst($user->role) }}</span>
                            @if($user->role === 'admin' && $user->admin_role)
                                <span class="ui-badge">{{ str_replace('_', ' ', ucfirst($user->admin_role)) }}</span>
                            @endif
                            @if($user->is_verified)
                                <span class="ui-badge border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-200">Verified</span>
                            @endif
                            @if($user->banned_at)
                                <span class="ui-badge border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-200">Banned</span>
                            @elseif($user->status === 'suspended' || ($user->suspended_until && $user->suspended_until->isFuture()))
                                <span class="ui-badge border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/40 dark:bg-amber-900/30 dark:text-amber-200">Suspended</span>
                            @else
                                <span class="ui-badge">{{ ucfirst($user->status ?? 'active') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-2 text-center">
                        <div class="rounded-2xl border border-slate-200/70 px-4 py-3 dark:border-slate-800/70">
                            <div class="text-xs font-semibold text-slate-500 dark:text-slate-400">Tasks</div>
                            <div class="mt-1 text-xl font-extrabold">{{ $user->tasks_count }}</div>
                        </div>
                        <div class="rounded-2xl border border-slate-200/70 px-4 py-3 dark:border-slate-800/70">
                            <div class="text-xs font-semibold text-slate-500 dark:text-slate-400">Applications</div>
                            <div class="mt-1 text-xl font-extrabold">{{ $user->applications_count }}</div>
                        </div>
                        <div class="rounded-2xl border border-slate-200/70 px-4 py-3 dark:border-slate-800/70">
                            <div class="text-xs font-semibold text-slate-500 dark:text-slate-400">Reviews</div>
                            <div class="mt-1 text-xl font-extrabold">{{ $user->reviews_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui-card">
            <div class="ui-card-body">
                <div class="mb-4 text-sm font-extrabold">Profile</div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Phone</div>
                        <div class="mt-1 text-sm">{{ $user->phone ?: 'Not provided' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">City</div>
                        <div class="mt-1 text-sm">{{ $user->city ?: 'Not provided' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Address</div>
                        <div class="mt-1 text-sm">{{ $user->address ?: 'Not provided' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Hourly Rate</div>
                        <div class="mt-1 text-sm">{{ $user->hourly_rate ? number_format((float) $user->hourly_rate, 2).' MAD' : '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Joined</div>
                        <div class="mt-1 text-sm">{{ $user->created_at?->format('Y-m-d H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Updated</div>
                        <div class="mt-1 text-sm">{{ $user->updated_at?->format('Y-m-d H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        @if($user->role === 'admin')
            <div class="ui-card">
                <div class="ui-card-body">
                    <div class="mb-4 text-sm font-extrabold">Admin Permissions</div>
                    @if($user->admin_role === 'super_admin')
                        <span class="ui-badge">All permissions</span>
                    @elseif($user->permissions->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach($user->permissions as $permission)
                                <span class="ui-badge">{{ $permission->label ?: $permission->key }}</span>
                            @endforeach
                        </div>
                    @else
                        <div class="text-sm text-slate-500 dark:text-slate-400">No granular permissions assigned.</div>
                    @endif
                </div>
            </div>
        @endif

        <div class="ui-card">
            <div class="ui-card-body">
                <div class="mb-4 text-sm font-extrabold">Recent History</div>
                <div class="space-y-3">
                    @forelse($history as $log)
                        <div class="rounded-2xl border border-slate-200/70 px-4 py-3 dark:border-slate-800/70">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <div class="font-semibold">{{ $log->action }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $log->created_at?->format('Y-m-d H:i') }}</div>
                            </div>
                            <div class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                                Actor: {{ $log->actor?->name ?? 'System' }}
                                @if($log->ip)
                                    · {{ $log->ip }}
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-slate-500 dark:text-slate-400">No history available yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="ui-card">
            <div class="ui-card-body">
                <div class="mb-4 text-sm font-extrabold">Quick Actions</div>
                <div class="grid gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="ui-btn ui-btn-primary">Edit User</a>
                    @if($user->id !== auth('admin')->id())
                        <form method="POST" action="{{ route('admin.users.verify', $user) }}">
                            @csrf
                            @method('PATCH')
                            <button class="ui-btn ui-btn-secondary w-full" type="submit">{{ $user->is_verified ? 'Remove Verification' : 'Verify User' }}</button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.password-reset', $user) }}">
                            @csrf
                            <button class="ui-btn ui-btn-secondary w-full" type="submit">Send Reset Link</button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user account?');">
                            @csrf
                            @method('DELETE')
                            <button class="ui-btn ui-btn-secondary w-full" type="submit">Delete User</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        @if($recentClientTasks->isNotEmpty())
            <div class="ui-card">
                <div class="ui-card-body">
                    <div class="mb-4 text-sm font-extrabold">Recent Client Tasks</div>
                    <div class="space-y-3">
                        @foreach($recentClientTasks as $task)
                            <div class="rounded-2xl border border-slate-200/70 px-4 py-3 dark:border-slate-800/70">
                                <div class="font-semibold">{{ $task->title }}</div>
                                <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $task->category?->name ?? 'No category' }} · {{ ucfirst(str_replace('_', ' ', $task->status)) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($recentAssignedTasks->isNotEmpty())
            <div class="ui-card">
                <div class="ui-card-body">
                    <div class="mb-4 text-sm font-extrabold">Recent Worker Assignments</div>
                    <div class="space-y-3">
                        @foreach($recentAssignedTasks as $task)
                            <div class="rounded-2xl border border-slate-200/70 px-4 py-3 dark:border-slate-800/70">
                                <div class="font-semibold">{{ $task->title }}</div>
                                <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $task->client?->name ?? 'No client' }} · {{ ucfirst(str_replace('_', ' ', $task->status)) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
