<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class GetUserByEmailAction
{
    /**
     * Get specific user by uuid.
     */
    public function execute(string $email): ?User
    {
        return User::query()
            ->whereEmail($email)
            ->first();
    }
}
