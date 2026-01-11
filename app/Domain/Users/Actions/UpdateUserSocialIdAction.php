<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class UpdateUserSocialIdAction
{
    /**
     * Update an email for existing user with email.
     */
    public function execute(User $user, string $socialId, string $provider): void
    {
        $user->update(['social_id' => $socialId, 'provider' => $provider]);
    }
}
