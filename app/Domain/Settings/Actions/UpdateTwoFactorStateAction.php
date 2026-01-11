<?php

namespace App\Domain\Settings\Actions;

use App\Domain\Settings\Models\Setting;
use App\Domain\Settings\States\TwoFactorStates\TwoFactorEnableState;
use App\Domain\Settings\States\TwoFactorStates\TwoFactorDisableState;

class UpdateTwoFactorStateAction
{
    /**
     * Update Two-Factor Authentication state and return the new state instance.
     */
    public function execute(Setting $setting): Setting
    {
        $newState = $setting->isTwoFactorEnabled()
            ? TwoFactorDisableState::class
            : TwoFactorEnableState::class;

        $setting->getTwoFactorState()->transitionTo($newState);

        return $setting->fresh();
    }
}
