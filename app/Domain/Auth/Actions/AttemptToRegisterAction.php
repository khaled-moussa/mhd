<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\Exceptions\FailedToRegisterException;
use App\Domain\Users\Actions\CreateUserAction;
use App\Domain\Users\Actions\GetUserByEmailAction;
use App\Domain\Users\DTOs\CreateUserDto;
use App\Domain\Users\Models\User;
use App\Domain\Users\Services\UserEmailRequestService;

class AttemptToRegisterAction
{
    public function execute(CreateUserDto $dto): User
    {
        $user = app(GetUserByEmailAction::class)->execute(email: $dto->email);

        if ($user) {
            throw new FailedToRegisterException;
        }

        $user = app(CreateUserAction::class)->execute(dto: $dto);

        // Fired verify email
        app(UserEmailRequestService::class)
            ->verifyEmailRequest(user: $user);

        return $user;
    }
}
