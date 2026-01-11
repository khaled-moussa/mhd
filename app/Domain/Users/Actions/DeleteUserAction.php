<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteUserAction
{
    /**
     * Delete the given user.
     */
    public function execute(User $user): void
    {
        if (! $user->exists) {
            throw new ModelNotFoundException('Cannot delete: User instance not found or already deleted.');
        }

        $user->delete();
    }
}
