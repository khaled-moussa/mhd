<?php

namespace App\Domain\Settings\Actions;

use App\Domain\Settings\Models\Setting;
use App\Domain\Settings\States\DesktopNotificationStates\DesktopNotificationDisableState;
use App\Domain\Settings\States\DesktopNotificationStates\DesktopNotificationEnableState;
use App\Domain\Settings\States\DesktopNotificationStates\DesktopNotificationStates;

class UpdateDesktopNotificationStateAction
{
    /**
     * Update Desktop-Notification state based on the Setting.
     */
    public function execute(Setting $setting): DesktopNotificationStates
    {
        $newState = $setting->isDesktopNotificationEnable()
            ? DesktopNotificationDisableState::class
            : DesktopNotificationEnableState::class;

        $setting->getDesktopNotificationState()->transitionTo($newState);

        return $setting->fresh()->getDesktopNotificationState();
    }
}
