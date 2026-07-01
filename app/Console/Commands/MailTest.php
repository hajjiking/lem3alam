<?php

namespace App\Console\Commands;

use App\Mail\AdminOtpMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MailTest extends Command
{
    protected $signature = 'mail:test {email} {--mailer=}';

    protected $description = 'Send a test OTP email to a recipient';

    public function handle(): int
    {
        $email = (string) $this->argument('email');
        $mailer = $this->option('mailer') ? (string) $this->option('mailer') : null;

        $emailRule = app()->environment('production') ? 'required|email:rfc,dns' : 'required|email';
        $validator = Validator::make(['email' => $email], ['email' => $emailRule]);
        if ($validator->fails()) {
            $this->components->error('Invalid email address.');

            return self::INVALID;
        }

        $domain = strtolower((string) substr(strrchr($email, '@') ?: '', 1));
        $blockedSuffixes = ['.invalid', '.test', '.example', '.localhost'];
        foreach ($blockedSuffixes as $suffix) {
            if ($domain !== '' && str_ends_with($domain, $suffix)) {
                $this->components->error('Recipient domain is blocked for delivery tests.');

                return self::INVALID;
            }
        }

        $correlationId = (string) Str::uuid();
        $code = (string) random_int(100000, 999999);
        $ttlMinutes = 10;

        Log::info('Mail test send attempt', [
            'correlation_id' => $correlationId,
            'email' => $email,
            'mailer' => $mailer ?? config('mail.default'),
        ]);

        $mail = new AdminOtpMail($code, $ttlMinutes);

        try {
            $sender = $mailer ? Mail::mailer($mailer) : Mail::mailer(config('mail.default'));
            retry(2, fn () => $sender->to($email)->send($mail), 200);
        } catch (\Throwable $e) {
            Log::error('Mail test send failed', [
                'correlation_id' => $correlationId,
                'email' => $email,
                'mailer' => $mailer ?? config('mail.default'),
                'error' => $e->getMessage(),
            ]);
            $this->components->error('Mail send failed. Check logs for correlation id: '.$correlationId);

            return self::FAILURE;
        }

        $this->components->info('Mail sent (or handed off to transport). Correlation id: '.$correlationId);

        return self::SUCCESS;
    }
}
