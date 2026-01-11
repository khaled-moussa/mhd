<?php

namespace App\Domain\Users\Services;

use App\Domain\Users\Events\{
    VerifyEmailRequestedEvent,
    VerifyNewEmailRequestedEvent,
    AccountDeletionRequestedEvent,
    ResetPasswordRequestedEvent,
    TwoFactorRequestedEvent,
};
use App\Domain\Users\Models\User;

class UserEmailRequestService
{
    public function verifyEmailRequest(User $user): void
    {
        VerifyEmailRequestedEvent::dispatch($user);
    }

    public function verifyNewEmailRequest(User $user): void
    {
        VerifyNewEmailRequestedEvent::dispatch($user);
    }

    public function accountDeletionRequest(User $user): void
    {
        AccountDeletionRequestedEvent::dispatch($user);
    }

    public function resetPasswordRequest(User $user): void
    {
        ResetPasswordRequestedEvent::dispatch($user);
    }

    public function verifyTwoFactorRequest(User $user): void
    {
        TwoFactorRequestedEvent::dispatch($user);
    }
}
