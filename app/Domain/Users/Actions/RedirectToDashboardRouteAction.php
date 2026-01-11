<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;
use App\Panel\Enums\PanelEnum;

class RedirectToDashboardRouteAction
{
    public function execute(User $user): string
    {
        return match ($user->panel()) {
            PanelEnum::ADMIN => 'admin.dashboard',
            PanelEnum::USER  => 'user.dashboard',
        };
    }
}
