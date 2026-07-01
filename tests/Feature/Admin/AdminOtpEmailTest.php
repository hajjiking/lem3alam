<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminOtpEmailTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        $created = User::factory()->create(['role' => 'admin']);
        if ($created instanceof User) {
            return $created;
        }

        return $created->firstOrFail();
    }

    #[Test]
    public function admin_login_does_not_require_otp_when_two_factor_disabled()
    {
        Mail::fake();

        $password = 'secret-password';
        $admin = $this->createAdmin();
        $admin->update([
            'password' => Hash::make($password),
        ]);

        $response = $this->post(route('admin.authenticate'), [
            'email' => $admin->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('admin_2fa_passed', true);

        Mail::assertNothingSent();
    }

    #[Test]
    public function resend_otp_route_redirects_to_dashboard_when_two_factor_disabled()
    {
        Mail::fake();

        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
            ->withSession(['admin_2fa_user_id' => $admin->id])
            ->post(route('admin.otp.resend'));

        $response->assertRedirect(route('admin.dashboard'));
        Mail::assertNothingSent();
    }
}
