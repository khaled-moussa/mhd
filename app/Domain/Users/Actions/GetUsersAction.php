<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class GetUsersAction
{
    /**
     * Get all users.
     */
    public function execute()
    {
        return User::query()
            ->latest('created_at')
            ->paginate(20);
    }
}
