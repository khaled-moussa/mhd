<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\Exceptions\PasswordResetTokenExpiredException;
use App\Domain\Users\Actions\GetUserByEmailAction;
use App\Domain\Users\Actions\UpdateUserPasswordAction;
use Illuminate\Support\Facades\Password;

class AttemptToChangePasswordAction
{
    public function execute(string $email, string $newPassword, string $token): void
    {
        $user = app(GetUserByEmailAction::class)->execute(email: $email);

        if (! $user) {
            throw new PasswordResetTokenExpiredException;
        }

        $tokenExists = Password::tokenExists(
            user: $user,
            token: $token
        );

        if (! $tokenExists) {
            throw new PasswordResetTokenExpiredException;
        }

        app(UpdateUserPasswordAction::class)
            ->execute(
                user: $user,
                newPassword: $newPassword
            );

        Password::deleteToken(
            user: $user
        );
    }
}
