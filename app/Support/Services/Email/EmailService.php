<?php

namespace App\Support\Services\Email;

use App\Domain\Auth\Emails\VerifyEmailLinkRequestMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;

class EmailService
{
    public function boot(): void
    {
        $this->customizeVerificationEmail();
        $this->customizeVerificationUrl();
    }

    private function customizeVerificationEmail(): void
    {
        VerifyEmail::toMailUsing(
            fn(object $notifiable, string $url) => (
                new VerifyEmailLinkRequestMail(
                    name: $notifiable->getFullName(),
                    verificationLink: $url
                ))->to($notifiable->getEmail())
        );
    }

    private function customizeVerificationUrl(): void
    {
        VerifyEmail::createUrlUsing(
            fn($notifiable) =>
            URL::temporarySignedRoute(
                'auth.verification.verify',
                now()->addMinutes(60),
                [
                    'id'   => $notifiable->getUuid(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            )
        );
    }
}
