<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class DeleteUserAccountAction
{
    /**
     * Delete existing user account.
     */
    public function execute(User $user): void
    {
        $user->deleteAllOneTimePasswords();
        $user->deleteQuietly();
    }
}
