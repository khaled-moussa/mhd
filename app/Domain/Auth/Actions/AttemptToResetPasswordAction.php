<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\Exceptions\FailedToForgetPasswordException;
use App\Domain\Users\Actions\GetUserByEmailAction;
use App\Domain\Users\Services\UserEmailRequestService;

class AttemptToResetPasswordAction
{
    public function execute(string $email): void
    {
        $user = app(GetUserByEmailAction::class)->execute(email: $email);

        if (! $user) {
            throw new FailedToForgetPasswordException;
        }

        // Fired reset password email
        app(UserEmailRequestService::class)
            ->resetPasswordRequest(user: $user);
    }
}
