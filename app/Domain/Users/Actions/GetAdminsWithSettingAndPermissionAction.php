<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;
use App\Panel\Enums\PanelEnum;
use Illuminate\Support\Collection;

class GetAdminsWithSettingAndPermissionAction
{
    /**
     * Create a new user.
     */
    public function execute(): Collection
    {
        return User::with(['setting', 'permissions'])
            ->wherePanelId(PanelEnum::ADMIN->value)
            ->get();
    }
}
