<?php

namespace App\Support\Services\Email;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use App\Domain\Auth\Emails\VerifyEmailLinkRequestMail;

class EmailService
{
    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    public static function boot(): void
    {
        self::registerVerificationMail();
        self::registerVerificationUrl();
    }

    /*
    |--------------------------------------------------------------------------
    | Verification Mail
    |--------------------------------------------------------------------------
    */

    private static function registerVerificationMail(): void
    {
        VerifyEmail::toMailUsing(
            fn (object $notifiable, string $url) =>
                self::buildVerificationMail($notifiable, $url)
        );
    }

    private static function buildVerificationMail(
        object $notifiable,
        string $url
    ): VerifyEmailLinkRequestMail {
        return (new VerifyEmailLinkRequestMail(
            name: $notifiable->getFullName(),
            verificationLink: $url,
        ))->to($notifiable->getEmail());
    }

    /*
    |--------------------------------------------------------------------------
    | Verification URL
    |--------------------------------------------------------------------------
    */

    private static function registerVerificationUrl(): void
    {
        VerifyEmail::createUrlUsing(
            fn (object $notifiable): string =>
                self::buildVerificationUrl($notifiable)
        );
    }

    private static function buildVerificationUrl(object $notifiable): string
    {
        return URL::temporarySignedRoute(
            'auth.verification.verify',
            now()->addMinutes(60),
            [
                'id'   => $notifiable->getUuid(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}