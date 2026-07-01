<?php

namespace Tests\Feature\Admin;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_can_soft_delete_and_restore_a_user(): void
    {
        Permission::query()->firstOrCreate([
            'key' => 'manage_users',
        ], [
            'label' => 'Manage users',
            'group' => 'users',
        ]);

        $admin = User::factory()->create([
            'role' => 'admin',
            'admin_role' => 'super_admin',
        ]);

        $user = User::factory()->create([
            'role' => 'client',
        ]);

        $this->actingAs($admin, 'admin')
            ->delete(route('admin.users.destroy', $user))
            ->assertRedirect(route('admin.users.index'));

        $this->assertSoftDeleted('users', ['id' => $user->id]);

        $this->actingAs($admin, 'admin')
            ->post(route('admin.users.restore', $user->id))
            ->assertRedirect(route('admin.users.index', ['trashed' => 'with']));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => null,
        ]);
    }

    #[Test]
    public function admin_can_update_user_role_and_permissions(): void
    {
        $permission = Permission::query()->firstOrCreate([
            'key' => 'manage_tasks',
        ], [
            'label' => 'Manage tasks',
            'group' => 'tasks',
        ]);

        $admin = User::factory()->create([
            'role' => 'admin',
            'admin_role' => 'super_admin',
        ]);

        $user = User::factory()->create([
            'role' => 'client',
        ]);

        $this->actingAs($admin, 'admin')
            ->put(route('admin.users.update', $user), [
                'name' => 'Updated Admin',
                'email' => $user->email,
                'role' => 'admin',
                'admin_role' => 'moderator',
                'status' => 'active',
                'is_verified' => 1,
                'permissions' => [$permission->key],
            ])->assertRedirect(route('admin.users.index'));

        $user->refresh();

        $this->assertSame('admin', $user->role);
        $this->assertSame('moderator', $user->admin_role);
        $this->assertTrue($user->permissions()->whereKey($permission->id)->exists());
    }
}
