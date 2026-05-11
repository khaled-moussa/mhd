<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Users\Models\User;
use App\Domain\Users\Actions\GetUserByEmailAction;
use App\Domain\Auth\Exceptions\FailedToLoginException;
use Illuminate\Support\Facades\Hash;

class AttemptToLoginAction
{
    public function execute(string $email, string $password): ?User
    {
        $user = app(GetUserByEmailAction::class)->execute(email: $email);

        if (! $user || ! Hash::check($password, $user->getPassword())) {
            throw new FailedToLoginException();
        }

        return $user;
    }
}
