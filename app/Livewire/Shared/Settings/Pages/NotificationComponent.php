<?php

namespace App\Livewire\Shared\Settings\Pages;

use App\Domain\Settings\Actions\UpdateDesktopNotificationStateAction;
use App\Domain\Settings\Actions\UpdateEmailNotificationStateAction;
use App\Livewire\Shared\Settings\Bases\BaseSettingComponent;

class NotificationComponent extends BaseSettingComponent
{
    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    public bool $desktopNotificationState = false;
    public bool $emailNotificationState = false;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function mount(): void
    {
        $this->desktopNotificationState = $this->setting
            ->getDesktopNotificationState()
            ->value();

        $this->emailNotificationState = $this->setting
            ->getEmailNotificationState()
            ->value();
    }

    public function render()
    {
        return view('livewire.shared.settings.pages.notification-component');
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function updateDesktopNotificationState(): void
    {
        $state = app(UpdateDesktopNotificationStateAction::class)
            ->execute(
                setting: $this->setting
            );

        $this->desktopNotificationState = $state->value();
    }

    public function updateEmailNotificationState(): void
    {
        $state = app(UpdateEmailNotificationStateAction::class)
            ->execute(
                setting: $this->setting
            );

        $this->emailNotificationState = $state->value();
    }
}
