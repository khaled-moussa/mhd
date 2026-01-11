<?php

namespace App\Domain\Users\Events;

use App\Domain\Users\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class VerifyEmailRequestedEvent
{
    use Dispatchable;

    public function __construct(
        public User $user
    ) {}
}
