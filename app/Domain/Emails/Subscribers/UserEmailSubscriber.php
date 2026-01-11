<?php

namespace App\Domain\Emails\Subscribers;

use App\Domain\Emails\Actions\SendAccountDeletionEmailAction;
use App\Domain\Emails\Actions\SendResetPasswordEmailAction;
use App\Domain\Emails\Actions\SendTwoFactorEmailAction;
use App\Domain\Emails\Actions\SendVerifyEmailAction;
use App\Domain\Emails\Actions\SendVerifyNewEmailAction;
use App\Domain\Users\Events\{
    VerifyEmailRequestedEvent,
    VerifyNewEmailRequestedEvent,
    AccountDeletionRequestedEvent,
    ResetPasswordRequestedEvent,
    TwoFactorRequestedEvent
};

class UserEmailSubscriber
{
    public function handleVerifyEmail(VerifyEmailRequestedEvent $event): void
    {
        app(SendVerifyEmailAction::class)->execute($event->user);
    }

    public function handleVerifyNewEmail(VerifyNewEmailRequestedEvent $event): void
    {
        app(SendVerifyNewEmailAction::class)->execute($event->user, $event->newEmail);
    }

    public function handleAccountDeletion(AccountDeletionRequestedEvent $event): void
    {
        app(SendAccountDeletionEmailAction::class)->execute($event->user);
    }

    public function handleResetPassword(ResetPasswordRequestedEvent $event): void
    {
        app(SendResetPasswordEmailAction::class)->execute($event->user->getEmail());
    }

    public function handleTwoFactor(TwoFactorRequestedEvent $event): void
    {
        app(SendTwoFactorEmailAction::class)->execute($event->user);
    }

    public function subscribe($events): void
    {
        $events->listen(
            VerifyEmailRequestedEvent::class,
            [self::class, 'handleVerifyEmail']
        );

        $events->listen(
            VerifyNewEmailRequestedEvent::class,
            [self::class, 'handleVerifyNewEmail']
        );

        $events->listen(
            AccountDeletionRequestedEvent::class,
            [self::class, 'handleAccountDeletion']
        );

        $events->listen(
            ResetPasswordRequestedEvent::class,
            [self::class, 'handleResetPassword']
        );

        $events->listen(
            TwoFactorRequestedEvent::class,
            [self::class, 'handleTwoFactor']
        );
    }
}
