<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\Exceptions\FailedToLoginException;
use App\Domain\Users\Actions\GetUserByEmailAction;
use App\Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class AttemptToLoginAction
{
    public function execute(string $email, string $password): ?User
    {
        $user = app(GetUserByEmailAction::class)
            ->execute(email: $email);

        if (! $user) {
            throw new FailedToLoginException;
        }

        $isPasswordCorrect = Hash::check($password, $user->getPassword());

        if (! $isPasswordCorrect) {
            throw new FailedToLoginException;
        }

        return $user;
    }
}
