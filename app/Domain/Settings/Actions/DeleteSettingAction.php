<?php

namespace App\Domain\Settings\Actions;

use App\Domain\Settings\Models\Setting;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteSettingAction
{
    /**
     * Delete the given setting.
     */
    public function execute(Setting $setting): void
    {
        if (! $setting->exists) {
            throw new ModelNotFoundException('Cannot delete: Setting instance not found or already deleted.');
        }

        $setting->delete();
    }
}
