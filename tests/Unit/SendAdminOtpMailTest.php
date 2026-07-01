<?php

namespace Tests\Unit;

use App\Jobs\SendAdminOtpMail;
use App\Mail\AdminOtpMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SendAdminOtpMailTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function job_sends_mail_for_valid_admin_recipient()
    {
        Mail::fake();

        $admin = User::factory()->create(['role' => 'admin']);

        $job = new SendAdminOtpMail(
            adminId: $admin->id,
            email: $admin->email,
            code: '123456',
            ttlMinutes: 10,
            correlationId: 'test-correlation-id'
        );

        $job->handle();

        Mail::assertSent(AdminOtpMail::class, function (AdminOtpMail $mail) use ($admin) {
            return $mail->hasTo($admin->email);
        });
    }

    #[Test]
    public function job_skips_mail_when_recipient_domain_is_invalid_in_production_mode()
    {
        Mail::fake();

        config(['app.env' => 'production']);

        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.invalid',
        ]);

        $job = new SendAdminOtpMail(
            adminId: $admin->id,
            email: $admin->email,
            code: '123456',
            ttlMinutes: 10,
            correlationId: 'test-correlation-id'
        );

        $job->handle();

        Mail::assertNothingSent();
    }
}
