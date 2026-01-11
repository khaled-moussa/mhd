<?php

namespace App\Domain\Settings\Actions;

use App\Domain\Settings\Models\Setting;

class GetSettingByUserIdAction
{
    /**
     * Get specific setting by user Id.
     */
    public function execute(int $userId): ?Setting
    {
        return Setting::query()
            ->whereUserId($userId)
            ->first();
    }
}
