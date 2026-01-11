<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\DTOs\UpdateUserDto;
use App\Domain\Users\Models\User;

class UpdateUserAction
{
    /**
     * Update an existing user with new data.
     */
    public function execute(User $user, UpdateUserDto $dto): User
    {
        $user->update($dto->toArray());

        return $user->fresh();
    }
}
