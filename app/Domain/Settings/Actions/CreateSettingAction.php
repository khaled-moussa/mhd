<?php

namespace App\Domain\Settings\Actions;

use App\Domain\Settings\Models\Setting;

class CreateSettingAction
{
    /**
     * Create a new setting.
     */
    public function execute(int $userId): ?Setting
    {
        return Setting::create(['user_id' => $userId]);
    }
}
