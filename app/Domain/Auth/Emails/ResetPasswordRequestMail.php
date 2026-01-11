<?php

namespace App\Domain\Auth\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ResetPasswordRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 30;

    /**
     * Retry backoff (seconds).
     */
    public function backoff(): array
    {
        return [5, 15, 30];
    }

    /**
     * Create a new message instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $resetLink,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                address: config('mail.from.address'),
                name: config('mail.from.name'),
            ),
            subject: __('Reset Your Password'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'pages.emails.reset-password',
            with: [
                'name' => $this->name,
                'resetPasswordLink' => $this->resetLink,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Handle a failed queued mail.
     */
    public function failed(Throwable $exception): void
    {
        logger()->error('Reset password mail failed', [
            'file_name' => 'ResetPasswordRequestMail',
            'user_name' => $this->name,
            'exception' => $exception->getMessage(),
        ]);
    }
}
