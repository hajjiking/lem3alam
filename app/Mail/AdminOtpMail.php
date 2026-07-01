<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $code,
        public int $ttlMinutes
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your M3alam Admin OTP Code'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-otp',
            with: [
                'code' => $this->code,
                'ttlMinutes' => $this->ttlMinutes,
            ]
        );
    }
}
