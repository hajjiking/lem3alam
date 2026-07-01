<?php

namespace App\Jobs;

use App\Mail\AdminOtpMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SendAdminOtpMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;

    public array $backoff = [30, 60, 120, 300];

    public function __construct(
        public int $adminId,
        public string $email,
        public string $code,
        public int $ttlMinutes,
        public string $correlationId
    ) {}

    public function handle(): void
    {
        $admin = User::find($this->adminId);
        if (! $admin || ! $admin->isAdmin()) {
            Log::warning('Admin OTP mail skipped: invalid admin', [
                'correlation_id' => $this->correlationId,
                'admin_id' => $this->adminId,
            ]);

            return;
        }

        if ($admin->email !== $this->email) {
            Log::warning('Admin OTP mail skipped: email mismatch', [
                'correlation_id' => $this->correlationId,
                'admin_id' => $this->adminId,
                'expected_email' => $this->email,
                'actual_email' => $admin->email,
            ]);

            return;
        }

        $emailRule = app()->environment('production') ? 'required|email:rfc,dns' : 'required|email';
        $validator = Validator::make(['email' => $this->email], ['email' => $emailRule]);
        if ($validator->fails()) {
            Log::warning('Admin OTP mail skipped: invalid recipient email', [
                'correlation_id' => $this->correlationId,
                'admin_id' => $this->adminId,
                'email' => $this->email,
                'errors' => $validator->errors()->toArray(),
            ]);

            return;
        }

        $domain = strtolower((string) substr(strrchr($this->email, '@') ?: '', 1));
        $blockedSuffixes = ['.invalid', '.test', '.example', '.localhost'];
        foreach ($blockedSuffixes as $suffix) {
            if ($domain !== '' && str_ends_with($domain, $suffix)) {
                Log::warning('Admin OTP mail skipped: blocked recipient domain', [
                    'correlation_id' => $this->correlationId,
                    'admin_id' => $this->adminId,
                    'email' => $this->email,
                    'domain' => $domain,
                    'suffix' => $suffix,
                ]);

                return;
            }
        }

        Log::info('Admin OTP mail queued attempt', [
            'correlation_id' => $this->correlationId,
            'admin_id' => $this->adminId,
            'email' => $this->email,
            'mailer' => config('mail.default'),
            'queue_connection' => config('queue.default'),
            'attempt' => $this->attempts(),
        ]);

        Mail::to($this->email)->send(new AdminOtpMail($this->code, $this->ttlMinutes));

        Log::info('Admin OTP mail queued attempt succeeded', [
            'correlation_id' => $this->correlationId,
            'admin_id' => $this->adminId,
            'email' => $this->email,
            'mailer' => config('mail.default'),
            'queue_connection' => config('queue.default'),
            'attempt' => $this->attempts(),
        ]);
    }

    public function failed(Throwable $e): void
    {
        Log::error('Admin OTP mail queued attempt failed', [
            'correlation_id' => $this->correlationId,
            'admin_id' => $this->adminId,
            'email' => $this->email,
            'mailer' => config('mail.default'),
            'queue_connection' => config('queue.default'),
            'attempt' => $this->attempts(),
            'error' => $e->getMessage(),
        ]);
    }
}
