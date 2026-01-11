<?php

namespace App\Domain\Settings\Actions;

use App\Domain\Settings\Models\Setting;
use App\Domain\Settings\States\EmailNotificationStates\EmailNotificationDisableState;
use App\Domain\Settings\States\EmailNotificationStates\EmailNotificationEnableState;
use App\Domain\Settings\States\EmailNotificationStates\EmailNotificationStates;

class UpdateEmailNotificationStateAction
{
    /**
     * Update Email-Notification state based on the Setting.
     */
    public function execute(Setting $setting): EmailNotificationStates
    {
        $newState = $setting->isEmailNotificationEnable()
            ? EmailNotificationDisableState::class
            : EmailNotificationEnableState::class;

        $setting->getEmailNotificationState()->transitionTo($newState);

        return $setting->fresh()->getEmailNotificationState();
    }
}
