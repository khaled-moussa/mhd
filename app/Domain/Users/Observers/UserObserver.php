<?php

namespace App\Domain\Users\Observers;

use App\Domain\Settings\Actions\CreateSettingAction;
use App\Domain\Users\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        app(CreateSettingAction::class)
            ->execute(userId: $user->getId());
    }
}
