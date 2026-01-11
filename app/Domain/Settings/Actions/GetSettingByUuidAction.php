<?php

namespace App\Domain\Settings\Actions;

use App\Domain\Settings\Models\Setting;

class GetSettingByUuidAction
{
    /**
     * Get specific setting by uuid.
     */
    public function execute(string $settingUuid): ?Setting
    {
        return Setting::query()
            ->whereUuid($settingUuid)
            ->first();
    }
}
