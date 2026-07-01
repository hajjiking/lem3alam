@extends('admin.layouts.app')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('page-actions')
<a href="{{ route('admin.users.create') }}" class="ui-btn ui-btn-primary">
    <i class="fas fa-plus"></i>
    <span>Add User</span>
</a>
@endsection

@section('content')
<div class="ui-card">
    <div class="ui-card-body">
        <form method="GET" action="{{ route('admin.users.index') }}" class="grid gap-3 md:grid-cols-12">
            <div class="md:col-span-4">
                <label class="ui-label" for="q">Search</label>
                <input id="q" name="q" value="{{ $filters['q'] ?? '' }}" class="ui-input" placeholder="Name, email, phone, city">
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="role">Role</label>
                <select id="role" name="role" class="ui-input">
                    <option value="">All roles</option>
                    @foreach(['client' => 'Client', 'tasker' => 'Worker', 'admin' => 'Admin'] as $value => $label)
                        <option value="{{ $value }}" @selected(($filters['role'] ?? '') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="admin_role">Admin Role</label>
                <select id="admin_role" name="admin_role" class="ui-input">
                    <option value="">All admin roles</option>
                    @foreach($adminRoles as $value => $label)
                        <option value="{{ $value }}" @selected(($filters['admin_role'] ?? '') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="status">Status</label>
                <select id="status" name="status" class="ui-input">
                    <option value="">All statuses</option>
                    <option value="active" @selected(($filters['status'] ?? '') === 'active')>Active</option>
                    <option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>Inactive</option>
                    <option value="suspended" @selected(($filters['status'] ?? '') === 'suspended')>Suspended</option>
                    <option value="suspended_now" @selected(($filters['status'] ?? '') === 'suspended_now')>Suspended now</option>
                    <option value="banned" @selected(($filters['status'] ?? '') === 'banned')>Banned</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="verified">Verification</label>
                <select id="verified" name="verified" class="ui-input">
                    <option value="">Any</option>
                    <option value="1" @selected(($filters['verified'] ?? '') === '1')>Verified</option>
                    <option value="0" @selected(($filters['verified'] ?? '') === '0')>Unverified</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="trashed">Deleted</label>
                <select id="trashed" name="trashed" class="ui-input">
                    <option value="">Active only</option>
                    <option value="with" @selected(($filters['trashed'] ?? '') === 'with')>With deleted</option>
                    <option value="only" @selected(($filters['trashed'] ?? '') === 'only')>Only deleted</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="sort">Sort</label>
                <select id="sort" name="sort" class="ui-input">
                    <option value="created_at" @selected(($filters['sort'] ?? 'created_at') === 'created_at')>Created</option>
                    <option value="name" @selected(($filters['sort'] ?? '') === 'name')>Name</option>
                    <option value="email" @selected(($filters['sort'] ?? '') === 'email')>Email</option>
                    <option value="role" @selected(($filters['sort'] ?? '') === 'role')>Role</option>
                    <option value="status" @selected(($filters['sort'] ?? '') === 'status')>Status</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="ui-label" for="direction">Direction</label>
                <select id="direction" name="direction" class="ui-input">
                    <option value="desc" @selected(($filters['direction'] ?? 'desc') === 'desc')>Descending</option>
                    <option value="asc" @selected(($filters['direction'] ?? '') === 'asc')>Ascending</option>
                </select>
            </div>
            <div class="md:col-span-8 flex items-end gap-2">
                <button class="ui-btn ui-btn-primary" type="submit">Apply Filters</button>
                <a class="ui-btn ui-btn-secondary" href="{{ route('admin.users.index') }}">Reset</a>
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
                        <th class="py-3 pe-4">User</th>
                        <th class="py-3 pe-4">Role</th>
                        <th class="py-3 pe-4">Status</th>
                        <th class="py-3 pe-4">Permissions</th>
                        <th class="py-3 pe-4">Activity</th>
                        <th class="py-3 pe-4">Joined</th>
                        <th class="py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/70 dark:divide-slate-800/70">
                    @forelse($users as $user)
                        <tr class="{{ $user->trashed() ? 'opacity-70' : '' }}">
                            <td class="py-4 pe-4 align-top">
                                <div class="font-semibold">{{ $user->name }}</div>
                                <div class="text-slate-600 dark:text-slate-300">{{ $user->email }}</div>
                                <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                    #{{ $user->id }}
                                    @if($user->phone)
                                        · {{ $user->phone }}
                                    @endif
                                    @if($user->city)
                                        · {{ $user->city }}
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 pe-4 align-top">
                                <div class="flex flex-wrap gap-2">
                                    <span class="ui-badge">{{ ucfirst($user->role) }}</span>
                                    @if($user->role === 'admin' && $user->admin_role)
                                        <span class="ui-badge">{{ $adminRoles[$user->admin_role] ?? $user->admin_role }}</span>
                                    @endif
                                    @if($user->is_verified)
                                        <span class="ui-badge border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-200">Verified</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 pe-4 align-top">
                                <div class="flex flex-wrap gap-2">
                                    @if($user->trashed())
                                        <span class="ui-badge border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-200">Deleted</span>
                                    @endif
                                    @if($user->banned_at)
                                        <span class="ui-badge border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-200">Banned</span>
                                    @elseif($user->status === 'suspended' || ($user->suspended_until && $user->suspended_until->isFuture()))
                                        <span class="ui-badge border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/40 dark:bg-amber-900/30 dark:text-amber-200">Suspended</span>
                                    @elseif($user->status === 'inactive')
                                        <span class="ui-badge">Inactive</span>
                                    @else
                                        <span class="ui-badge border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-900/30 dark:text-emerald-200">Active</span>
                                    @endif
                                </div>
                                @if($user->suspended_until)
                                    <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">Until {{ $user->suspended_until->format('Y-m-d H:i') }}</div>
                                @endif
                                @if($user->ban_reason)
                                    <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $user->ban_reason }}</div>
                                @endif
                            </td>
                            <td class="py-4 pe-4 align-top">
                                @if($user->role === 'admin')
                                    @if($user->admin_role === 'super_admin')
                                        <span class="ui-badge">All permissions</span>
                                    @elseif($user->permissions->isNotEmpty())
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($user->permissions->take(3) as $permission)
                                                <span class="ui-badge">{{ $permission->label ?: $permission->key }}</span>
                                            @endforeach
                                            @if($user->permissions->count() > 3)
                                                <span class="ui-badge">+{{ $user->permissions->count() - 3 }}</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-slate-400">No granular permissions</span>
                                    @endif
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="py-4 pe-4 align-top text-slate-600 dark:text-slate-300">
                                <div>{{ $user->tasks_count }} client tasks</div>
                                <div>{{ $user->applications_count }} applications</div>
                                <div>{{ $user->reviews_count }} reviews</div>
                            </td>
                            <td class="py-4 pe-4 align-top text-slate-600 dark:text-slate-300">
                                {{ $user->created_at?->format('M d, Y') }}
                            </td>
                            <td class="py-4 align-top">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="ui-btn ui-btn-ghost">View</a>
                                    @if(!$user->trashed())
                                        <a href="{{ route('admin.users.edit', $user) }}" class="ui-btn ui-btn-secondary">Edit</a>
                                    @endif

                                    @if(!$user->trashed() && $user->id !== auth('admin')->id())
                                        <form method="POST" action="{{ route('admin.users.verify', $user) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="ui-btn ui-btn-ghost" type="submit">{{ $user->is_verified ? 'Unverify' : 'Verify' }}</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="ui-btn ui-btn-ghost" type="submit">{{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.users.suspend', $user) }}">
                                            @csrf
                                            @method('PATCH')
                                            @if($user->status === 'suspended' || ($user->suspended_until && $user->suspended_until->isFuture()))
                                                <input type="hidden" name="clear" value="1">
                                                <button class="ui-btn ui-btn-ghost" type="submit">Unsuspend</button>
                                            @else
                                                <button class="ui-btn ui-btn-ghost" type="submit">Suspend 7d</button>
                                            @endif
                                        </form>

                                        <form method="POST" action="{{ route('admin.users.ban', $user) }}">
                                            @csrf
                                            @method('PATCH')
                                            @if($user->banned_at)
                                                <input type="hidden" name="clear" value="1">
                                                <button class="ui-btn ui-btn-ghost" type="submit">Unban</button>
                                            @else
                                                <input type="hidden" name="reason" value="Banned by administrator">
                                                <button class="ui-btn ui-btn-ghost" type="submit">Ban</button>
                                            @endif
                                        </form>

                                        <form method="POST" action="{{ route('admin.users.password-reset', $user) }}">
                                            @csrf
                                            <button class="ui-btn ui-btn-ghost" type="submit">Reset Password</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user account?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="ui-btn ui-btn-secondary" type="submit">Delete</button>
                                        </form>
                                    @endif

                                    @if($user->trashed())
                                        <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                                            @csrf
                                            <button class="ui-btn ui-btn-primary" type="submit">Restore</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-slate-500 dark:text-slate-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
