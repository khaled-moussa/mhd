<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class UpdateUserPasswordAction
{
    /**
     * Update an password for existing user with password.
     */
    public function execute(User $user, string $newPassword): void
    {
        $user->update(['password' => $newPassword]);
    }
}
