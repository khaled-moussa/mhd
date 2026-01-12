<?php

namespace App\Livewire\Shared\Settings\Pages;

use App\App\Web\Resources\Users\UsersResource;
use App\Livewire\Shared\Settings\Bases\BaseSettingComponent;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class SecurityComponent extends BaseSettingComponent
{
    /* 
    |-----------------------------
    | Properties
    |-----------------------------
    */
    public array $userData = [];
    public ?string $twoFactorStateLabel = null;

    /* 
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function mount(): void
    {
        $this->syncUserData();

        $this->twoFactorStateLabel = $this->setting
            ->getTwoFactorState()
            ->buttonLabel();
    }

    public function render()
    {
        return view('livewire.shared.settings.pages.security-component');
    }

    /* 
    |-----------------------------
    | State Sync
    |-----------------------------
    */
    protected function syncUserData(): void
    {
        $this->userData = $this->loadUserData;
    }

    /* 
    |-----------------------------
    | Computed
    |-----------------------------
    */
    #[Computed]
    public function loadUserData(): array
    {
        return (new UsersResource($this->user))->resolve();
    }

    /* 
    |-----------------------------
    | Listeners
    |-----------------------------
    */
    #[On(EventsEnum::USER_EMAIL_UPDATED_EVENT->value)]
    public function listenToEmailUpdatedEvent(): void
    {
        $this->syncUserData();
    }

    #[On(EventsEnum::USER_TWO_FACTOR_UPDATED_EVENT->value)]
    public function listenToTwoFactorUpdatedEvent(string $twoFactorStateLabel): void
    {
        $this->twoFactorStateLabel = $twoFactorStateLabel;
    }
}
