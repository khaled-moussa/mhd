<?php

namespace App\Domain\Emails\Actions;

use App\Domain\Auth\Emails\ResetPasswordRequestMail;
use App\Domain\Users\Exceptions\UserNotFoundException;
use App\Domain\Users\Actions\GetUserByEmailAction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class SendResetPasswordEmailAction
{
    public function execute(string $email): void
    {
        $user = app(GetUserByEmailAction::class)
            ->execute(
                email: $email
            );

        if (! $user) {
            throw new UserNotFoundException;
        }

        Mail::to($user->getEmail())
            ->send(new ResetPasswordRequestMail(
                name: $user->getFullName(),
                resetLink: route('auth.reset-password', [
                    'email' => $user->getEmail(),
                    'token' => Password::createToken($user),
                ])
            ));
    }
}
