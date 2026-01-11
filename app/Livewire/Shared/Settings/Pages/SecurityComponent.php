<?php

namespace App\Livewire\Shared\Settings\Pages;

use App\App\Web\Resources\Users\UsersResource;
use App\Domain\Settings\Actions\UnlinkSoicalProviderSign;
use App\Livewire\Shared\Settings\Bases\BaseSettingComponent;
use App\Support\Enums\EventsEnum;
use App\Support\Enums\GoogleSignStateEnum;
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
    public GoogleSignStateEnum $googleSignState;
    public ?string $twoFactorStateLabel = null;

    /* 
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function mount(): void
    {
        $this->syncUserData();
        $this->syncGoogleState();

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
    | Actions
    |-----------------------------
    */
    public function handleLinkingWithGoogle(): void
    {
        if ($this->hasGoogleSign()) {
            app(UnlinkSoicalProviderSign::class)
                ->execute(
                    user: $this->user,
                );

            $this->syncGoogleState();

            return;
        }
        session()->put('redirect_to_settings', true);

        $this->redirectRoute('auth.redirect', [
            'provider' => 'google',
        ]);
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

    protected function syncGoogleState(): void
    {
        $this->googleSignState = GoogleSignStateEnum::fromBool($this->hasGoogleSign());
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

    public function hasGoogleSign(): bool
    {
        return $this->user->hasSocialSign()
            && $this->user->hasGoogleSign();
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
