<?php

namespace App\Domain\Emails\Actions;

use App\Domain\Auth\Notifications\VerifyEmailRequestNotification;
use App\Domain\Users\Models\User;

class SendVerifyEmailAction
{
    public function execute(User $user): void
    {
        $user->notify(new VerifyEmailRequestNotification());
    }
}
