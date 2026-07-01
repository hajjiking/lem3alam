@extends('admin.layouts.app')

@php($mode = $mode ?? 'edit')
@php($isCreate = $mode === 'create')

@section('title', $isCreate ? 'Create User' : 'Edit User')
@section('page-title', $isCreate ? 'Create User' : 'Edit User')

@section('page-actions')
<a href="{{ route('admin.users.index') }}" class="ui-btn ui-btn-secondary">
    <i class="fas fa-arrow-left"></i>
    <span>Back to Users</span>
</a>
@endsection

@section('content')
@if($errors->any())
    <div class="mb-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 dark:border-rose-900/40 dark:bg-rose-900/30 dark:text-rose-100">
        <ul class="space-y-1 ps-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php($selectedPermissions = old('permissions', $user->permissions->pluck('key')->all() ?? []))

<form action="{{ $isCreate ? route('admin.users.store') : route('admin.users.update', $user) }}" method="POST" class="space-y-4" x-data="{ role: '{{ old('role', $user->role ?: 'client') }}' }">
    @csrf
    @unless($isCreate)
        @method('PUT')
    @endunless

    <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
        <div class="xl:col-span-2">
            <div class="ui-card">
                <div class="ui-card-body space-y-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="name" class="ui-label">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="ui-input">
                        </div>
                        <div>
                            <label for="email" class="ui-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="ui-input">
                        </div>
                        <div>
                            <label for="phone" class="ui-label">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="ui-input">
                        </div>
                        <div>
                            <label for="city" class="ui-label">City</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}" class="ui-input">
                        </div>
                        <div class="md:col-span-2">
                            <label for="address" class="ui-label">Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" class="ui-input">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="password" class="ui-label">{{ $isCreate ? 'Password' : 'New Password' }}</label>
                            <input type="password" id="password" name="password" {{ $isCreate ? 'required' : '' }} autocomplete="new-password" class="ui-input">
                            @unless($isCreate)
                                <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">Leave blank to keep the current password.</div>
                            @endunless
                        </div>
                        <div>
                            <label for="password_confirmation" class="ui-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" {{ $isCreate ? 'required' : '' }} autocomplete="new-password" class="ui-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="ui-card">
                <div class="ui-card-body space-y-4">
                    <div>
                        <label for="role" class="ui-label">Role</label>
                        <select id="role" name="role" x-model="role" required class="ui-input">
                            <option value="client" @selected(old('role', $user->role) === 'client')>Client</option>
                            <option value="tasker" @selected(old('role', $user->role) === 'tasker')>Worker</option>
                            <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                        </select>
                    </div>

                    <div x-show="role === 'admin'" x-cloak>
                        <label for="admin_role" class="ui-label">Admin Role</label>
                        <select id="admin_role" name="admin_role" class="ui-input">
                            <option value="">Choose role</option>
                            @foreach($adminRoles as $value => $label)
                                <option value="{{ $value }}" @selected(old('admin_role', $user->admin_role) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="ui-label">Status</label>
                        <select id="status" name="status" required class="ui-input">
                            <option value="active" @selected(old('status', $user->status ?: 'active') === 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $user->status) === 'inactive')>Inactive</option>
                            <option value="suspended" @selected(old('status', $user->status) === 'suspended')>Suspended</option>
                        </select>
                    </div>

                    <div>
                        <label for="hourly_rate" class="ui-label">Hourly Rate</label>
                        <input type="number" step="0.01" min="0" id="hourly_rate" name="hourly_rate" value="{{ old('hourly_rate', $user->hourly_rate) }}" class="ui-input">
                    </div>

                    <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-3 py-2 dark:border-slate-800">
                        <input type="checkbox" name="is_verified" value="1" @checked(old('is_verified', $user->is_verified)) class="h-4 w-4 rounded border-slate-300 text-slate-900 dark:border-slate-700 dark:bg-slate-900">
                        <span class="text-sm font-semibold">Verified user</span>
                    </label>

                    <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-3 py-2 dark:border-slate-800">
                        <input type="checkbox" name="available" value="1" @checked(old('available', $user->available)) class="h-4 w-4 rounded border-slate-300 text-slate-900 dark:border-slate-700 dark:bg-slate-900">
                        <span class="text-sm font-semibold">Available for work</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="ui-card" x-show="role === 'admin'" x-cloak>
        <div class="ui-card-body">
            <div class="mb-3 text-sm font-extrabold">Granular Permissions</div>
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @forelse($permissionOptions as $group => $permissions)
                    <div class="rounded-2xl border border-slate-200/70 p-4 dark:border-slate-800/70">
                        <div class="mb-3 text-xs font-extrabold uppercase tracking-wide text-slate-500 dark:text-slate-400">{{ str_replace('_', ' ', $group) }}</div>
                        <div class="space-y-2">
                            @foreach($permissions as $permission)
                                <label class="flex items-start gap-3">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission['key'] }}" @checked(in_array($permission['key'], $selectedPermissions, true)) class="mt-1 h-4 w-4 rounded border-slate-300 text-slate-900 dark:border-slate-700 dark:bg-slate-900">
                                    <span class="text-sm">{{ $permission['label'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-sm text-slate-500 dark:text-slate-400">Permissions will appear after running migrations.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-2">
        <a href="{{ route('admin.users.index') }}" class="ui-btn ui-btn-secondary">Cancel</a>
        <button type="submit" class="ui-btn ui-btn-primary">{{ $isCreate ? 'Create User' : 'Update User' }}</button>
    </div>
</form>
@endsection
