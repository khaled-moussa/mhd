<?php

namespace App\Domain\Auth\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Spatie\OneTimePasswords\Models\OneTimePassword;
use Throwable;

class VerifyAccountDeletionRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Queue configuration.
     */
    public int $tries = 3;
    public int $timeout = 30;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly OneTimePassword $oneTimePassword,
    ) {}

    /**
     * Retry backoff (seconds).
     */
    public function backoff(): array
    {
        return [5, 15, 30];
    }

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
            subject: __('Confirm Account Deletion'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'pages.emails.verify-account-deletion',
            with: [
                'name' => $this->name,
                'code' => $this->oneTimePassword->password,
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
        logger()->warning('Account deletion verification mail failed', [
            'file_name' => 'VerifyAccountDeletionRequestMail',
            'user_name' => $this->name,
            'exception' => $exception->getMessage(),
        ]);
    }
}
