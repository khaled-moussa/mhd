<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class UpdateUserEmailAction
{
    /**
     * Update an email for existing user with email.
     */
    public function execute(User $user, string $email): void
    {
        $user->update(['email' => $email]);
    }
}
