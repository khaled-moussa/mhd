<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class GetUserByUuidAction
{
    /**
     * Get specific user by uuid.
     */
    public function execute(string $userUuid): ?User
    {
        return User::query()
            ->whereUuid($userUuid)
            ->first();
    }
}
