<?php

namespace App\Domain\Settings\Actions;

use App\Domain\Users\Exceptions\UserNotFoundException;
use App\Domain\Users\Models\User;

class UnlinkSoicalProviderSign
{
    public function execute(User $user): void
    {
        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->update(['provider' => null, 'social_id' => null]);
    }
}
