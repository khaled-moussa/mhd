<?php

namespace App\Livewire\Shared\Settings\Forms;

use App\Domain\Settings\Actions\UpdateTwoFactorStateAction;
use App\Livewire\Shared\Settings\Bases\BaseSettingComponent;use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use App\Support\Enums\FormStepEnum;

class UpdateTwoFactorFormComponent extends BaseSettingComponent
{
    use WithLivewireExceptionHandling;
    
    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    public SecurityStepsFormComponent $form;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view('livewire.shared.settings.forms.update-two-factor-form-component');
    }

    /* 
    |-------------------------------
    | Actions
    |------------------------------- 
    */
    public function submit(): void
    {
        $this->form->validate($this->form->rulesForStep());

        match ($this->form->step) {
            FormStepEnum::PASSWORD_STEP => $this->afterPasswordVerified(),
        };
    }

    public function afterPasswordVerified()
    {
        $setting = app(UpdateTwoFactorStateAction::class)
            ->execute(
                setting: $this->setting
            );

        $this->dispatchUserTwoFactorUpdatedEvent(
            twoFactorStateLabel: $setting->getTwoFactorState()->buttonLabel()
        );

        $this->resetForm();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    public function resetForm(): void
    {
        $this->form->resetForm();
    }

    /*
    |-----------------------------
    | Events
    |-----------------------------
    */
    private function dispatchUserTwoFactorUpdatedEvent(string $twoFactorStateLabel)
    {
        $this->dispatch(
            EventsEnum::USER_TWO_FACTOR_UPDATED_EVENT,
            twoFactorStateLabel: $twoFactorStateLabel
        );
    }
}
