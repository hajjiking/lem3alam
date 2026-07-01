<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Permission;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $users = User::query()
            ->with('permissions')
            ->withCount(['tasks', 'applications', 'reviews'])
            ->when($request->string('trashed')->value() === 'with', fn ($query) => $query->withTrashed())
            ->when($request->string('trashed')->value() === 'only', fn ($query) => $query->onlyTrashed())
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim((string) $request->input('q'));
                $query->where(function ($inner) use ($term) {
                    $inner->where('name', 'like', '%'.$term.'%')
                        ->orWhere('email', 'like', '%'.$term.'%')
                        ->orWhere('phone', 'like', '%'.$term.'%')
                        ->orWhere('city', 'like', '%'.$term.'%');
                });
            })
            ->when($request->filled('role'), fn ($query) => $query->where('role', $request->string('role')->value()))
            ->when($request->filled('admin_role'), fn ($query) => $query->where('admin_role', $request->string('admin_role')->value()))
            ->when($request->filled('status'), function ($query) use ($request) {
                $status = $request->string('status')->value();
                if ($status === 'banned') {
                    $query->whereNotNull('banned_at');
                } elseif ($status === 'suspended_now') {
                    $query->where(function ($inner) {
                        $inner->where('status', 'suspended')
                            ->orWhere('suspended_until', '>', now());
                    });
                } else {
                    $query->where('status', $status);
                }
            })
            ->when($request->filled('verified'), function ($query) use ($request) {
                $verified = $request->string('verified')->value() === '1';
                $query->where('is_verified', $verified);
            });

        [$sort, $direction] = $this->sortOptions($request);
        $users->orderBy($sort, $direction);

        return view('admin.users.index', [
            'users' => $users->paginate(15)->withQueryString(),
            'adminRoles' => $this->adminRoles(),
            'permissionOptions' => $this->permissionOptions(),
            'filters' => $request->only(['q', 'role', 'admin_role', 'status', 'verified', 'trashed', 'sort', 'direction']),
        ]);
    }

    public function show(User $user)
    {
        $user->load('permissions');
        $user->loadCount(['tasks', 'applications', 'reviews']);

        $recentClientTasks = Task::query()
            ->with(['category', 'assignedTasker'])
            ->where('client_id', $user->id)
            ->latest()
            ->limit(6)
            ->get();

        $recentAssignedTasks = Task::query()
            ->with(['category', 'client'])
            ->where('assigned_tasker_id', $user->id)
            ->latest()
            ->limit(6)
            ->get();

        $history = AuditLog::query()
            ->with('actor')
            ->where(function ($query) use ($user) {
                $query->where('actor_id', $user->id)
                    ->orWhere(function ($inner) use ($user) {
                        $inner->where('target_type', User::class)
                            ->where('target_id', $user->id);
                    });
            })
            ->latest('id')
            ->limit(12)
            ->get();

        return view('admin.users.show', compact('user', 'recentClientTasks', 'recentAssignedTasks', 'history'));
    }

    public function edit(User $user)
    {
        $mode = 'edit';

        $user->load('permissions');

        return view('admin.users.edit', [
            'user' => $user,
            'mode' => $mode,
            'adminRoles' => $this->adminRoles(),
            'permissionOptions' => $this->permissionOptions(),
        ]);
    }

    public function create()
    {
        $user = new User();
        $mode = 'create';

        return view('admin.users.edit', [
            'user' => $user,
            'mode' => $mode,
            'adminRoles' => $this->adminRoles(),
            'permissionOptions' => $this->permissionOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateUser($request);

        $user = User::create($this->buildUserPayload($validated, true));
        $this->syncPermissions($user, $validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $this->validateUser($request, $user);
        $user->update($this->buildUserPayload($validated, false, $user));
        $this->syncPermissions($user, $validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function toggleStatus(User $user)
    {
        if (auth('admin')->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot change your own status.');
        }

        $next = ($user->status ?? 'active') === 'active' ? 'inactive' : 'active';
        $user->update([
            'status' => $next,
            'suspended_until' => null,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User status updated successfully.');
    }

    public function verify(User $user)
    {
        $willVerify = ! $user->is_verified;

        $user->update([
            'is_verified' => $willVerify,
            'verified_at' => $willVerify ? now() : null,
            'email_verified_at' => $user->email_verified_at ?: now(),
        ]);

        return back()->with('success', $willVerify ? 'User verified successfully.' : 'User verification removed.');
    }

    public function suspend(Request $request, User $user)
    {
        if (auth('admin')->id() === $user->id) {
            return back()->with('error', 'You cannot suspend your own account.');
        }

        $clear = $request->boolean('clear');
        if ($clear) {
            $user->update([
                'status' => 'active',
                'suspended_until' => null,
            ]);

            return back()->with('success', 'User suspension removed.');
        }

        $data = $request->validate([
            'until' => ['nullable', 'date', 'after:now'],
        ]);

        $user->update([
            'status' => 'suspended',
            'suspended_until' => $data['until'] ?? now()->addDays(7),
        ]);

        return back()->with('success', 'User suspended successfully.');
    }

    public function ban(Request $request, User $user)
    {
        if (auth('admin')->id() === $user->id) {
            return back()->with('error', 'You cannot ban your own account.');
        }

        if ($request->boolean('clear')) {
            $user->update([
                'status' => 'active',
                'banned_at' => null,
                'ban_reason' => null,
            ]);

            return back()->with('success', 'User ban removed.');
        }

        $data = $request->validate([
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update([
            'status' => 'inactive',
            'banned_at' => now(),
            'ban_reason' => $data['reason'] ?? null,
        ]);

        return back()->with('success', 'User banned successfully.');
    }

    public function sendPasswordReset(User $user)
    {
        $status = Password::broker('users')->sendResetLink([
            'email' => $user->email,
        ]);

        return back()->with(
            $status === Password::RESET_LINK_SENT ? 'success' : 'error',
            $status === Password::RESET_LINK_SENT
                ? 'Password reset link sent successfully.'
                : __($status)
        );
    }

    public function restore(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.index', ['trashed' => 'with'])
            ->with('success', 'User restored successfully.');
    }

    public function destroy(User $user)
    {
        if (auth('admin')->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    private function validateUser(Request $request, ?User $user = null): array
    {
        $adminRoles = array_keys($this->adminRoles());

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['client', 'tasker', 'admin'])],
            'admin_role' => ['nullable', Rule::in($adminRoles)],
            'status' => ['required', Rule::in(['active', 'inactive', 'suspended'])],
            'phone' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
            'available' => ['nullable', 'boolean'],
            'is_verified' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::exists('permissions', 'key')],
        ]);
    }

    private function buildUserPayload(array $validated, bool $creating, ?User $existing = null): array
    {
        $isVerified = (bool) ($validated['is_verified'] ?? false);
        $role = (string) $validated['role'];

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $role,
            'admin_role' => $role === 'admin' ? ($validated['admin_role'] ?: 'admin') : null,
            'status' => $validated['status'],
            'phone' => $validated['phone'] ?? null,
            'city' => $validated['city'] ?? null,
            'address' => $validated['address'] ?? null,
            'hourly_rate' => $validated['hourly_rate'] ?? null,
            'available' => (bool) ($validated['available'] ?? false),
            'is_verified' => $isVerified,
            'verified_at' => $isVerified ? ($existing?->verified_at ?: now()) : null,
            'email_verified_at' => $isVerified ? ($existing?->email_verified_at ?: now()) : null,
        ];

        if ($payload['status'] !== 'suspended') {
            $payload['suspended_until'] = null;
        } elseif (! $existing?->suspended_until) {
            $payload['suspended_until'] = now()->addDays(7);
        }

        if ($creating || ! empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        return $payload;
    }

    private function syncPermissions(User $user, array $validated): void
    {
        if ($user->role !== 'admin') {
            $user->permissions()->detach();

            return;
        }

        if ($user->admin_role === 'super_admin') {
            $user->permissions()->detach();

            return;
        }

        $permissionIds = Permission::query()
            ->whereIn('key', $validated['permissions'] ?? [])
            ->pluck('id');

        $user->permissions()->sync($permissionIds);
    }

    private function adminRoles(): array
    {
        return [
            'super_admin' => 'Super Admin',
            'admin' => 'Admin',
            'moderator' => 'Moderator',
            'support' => 'Support',
        ];
    }

    private function permissionOptions(): array
    {
        return Permission::query()
            ->orderBy('group')
            ->orderBy('label')
            ->get()
            ->groupBy(fn (Permission $permission) => $permission->group ?: 'general')
            ->map(fn ($items) => $items->map(fn (Permission $permission) => [
                'key' => $permission->key,
                'label' => $permission->label ?: $permission->key,
            ])->all())
            ->all();
    }

    /**
     * @return array{0:string,1:string}
     */
    private function sortOptions(Request $request): array
    {
        $sort = $request->string('sort')->value() ?: 'created_at';
        $direction = strtolower($request->string('direction')->value() ?: 'desc');

        $allowedSorts = ['created_at', 'name', 'email', 'role', 'status'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'created_at';
        }

        if (! in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'desc';
        }

        return [$sort, $direction];
    }
}
