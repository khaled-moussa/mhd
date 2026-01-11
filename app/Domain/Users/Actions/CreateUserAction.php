<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\DTOs\CreateUserDto;
use App\Domain\Users\Models\User;

class CreateUserAction
{
    /**
     * Create a new user.
     */
    public function execute(CreateUserDto $dto): User
    {
        return User::create($dto->toArray());
    }
}
