<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class GetUserByIdAction
{
    /**
     * Get specific user by id.
     */
    public function execute(string $userUuid): ?User
    {
        return User::query()
            ->whereUuid($userUuid)
            ->first();
    }
}
