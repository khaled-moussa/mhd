<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\Exceptions\FailedToLoginException;
use App\Domain\Users\Actions\CreateUserAction;
use App\Domain\Users\Actions\GetUserByEmailAction;
use App\Domain\Users\Actions\UpdateUserSocialIdAction;
use App\Domain\Users\DTOs\CreateUserDto;
use App\Domain\Users\DTOs\UpdateUserDto;
use App\Domain\Users\Models\User;
use Laravel\Socialite\Contracts\User as UserProvider;
use Illuminate\Support\Facades\Hash;

class AttemptToLoginWithProviderAction
{
    /**
     * Attempt login via social provider.
     */
    public function execute(UserProvider $userProvider, string $provider): User
    {
        if (! $userProvider || !$provider) {
            throw new FailedToLoginException();
        }

        $user = app(GetUserByEmailAction::class)
            ->execute(email: $userProvider->getEmail());

        // Check if social ID matches
        $isSocialIdCorrect = $user && Hash::check(
            $userProvider->getId(),
            $user->getSocialId()
        );

        if ($user && !$isSocialIdCorrect) {
            app(UpdateUserSocialIdAction::class)
                ->execute(
                    user: $user,
                    socialId: $userProvider->getId(),
                    provider: $provider
                );
        }

        // If user doesn't exist or social ID mismatch, register user
        if (! $user && ! $isSocialIdCorrect) {
            $createUserDto = new CreateUserDto(
                firstName: $userProvider->user['given_name'] ?? $userProvider->getNickname(),
                lastName: $userProvider->user['family_name'] ?? null,
                email: $userProvider->getEmail(),
                password: $userProvider->getId(),
                socialId: $userProvider->getId(),
                provider: $provider,
            );

            app(CreateUserAction::class)
                ->execute(dto: $createUserDto);

            // Re-fetch the newly created user
            $user = app(GetUserByEmailAction::class)
                ->execute(email: $userProvider->getEmail());

            if (! $user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }
        }

        // Final social ID check
        if (! $user || ! Hash::check($userProvider->getId(), $user->getSocialId())) {
            throw new FailedToLoginException();
        }

        return $user;
    }
}
