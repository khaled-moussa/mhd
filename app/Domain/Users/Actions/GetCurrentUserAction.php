<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class GetCurrentUserAction
{
    /**
     * Get specific user by uuid.
     */
    public function execute(): ?User
    {
        return Auth::user();
    }
}
