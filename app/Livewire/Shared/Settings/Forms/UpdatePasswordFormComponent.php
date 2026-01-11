<?php

namespace App\Livewire\Shared\Settings\Forms;

use App\Domain\Users\Actions\UpdateUserPasswordAction;
use App\Livewire\Shared\Settings\Bases\BaseSettingComponent;use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;

class UpdatePasswordFormComponent extends BaseSettingComponent
{
    use WithLivewireExceptionHandling;
    
    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    public string $currentPassword;
    public string $newPassword;
    public string $confirmationPassword;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view('livewire.shared.settings.forms.update-password-form-component');
    }

    /*
    |-----------------------------
    | Validation Rules
    |-----------------------------
    */
    protected function rules(): array
    {
        return [
            'currentPassword' => [
                'required',
                'string',
                'min:8',
                'currentPassword'
            ],

            'newPassword' => [
                'required',
                'string',
                'min:8',
                'max:32',
                'different:currentPassword',
            ],

            'confirmationPassword' => [
                'required',
                'same:newPassword',
                'string',
                'min:8',
                'max:32',
            ],
        ];
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function submit(): void
    {
        $this->validate();

        app(UpdateUserPasswordAction::class)
            ->execute(
                user: $this->user,
                newPassword: $this->newPassword,
            );

        $this->dispatchUserPasswordUpdatedEvent();
        $this->resetForm();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    public function resetForm(): void
    {
        $this->reset([
            'currentPassword',
            'newPassword',
            'confirmationPassword'
        ]);

        $this->resetValidation();
        $this->resetErrorBag();
    }

    /*
    |-----------------------------
    | Dispatchers
    |-----------------------------
    */
    private function dispatchUserPasswordUpdatedEvent()
    {
        $this->dispatch(EventsEnum::USER_PASSWORD_UPDATED_EVENT);
    }
}
