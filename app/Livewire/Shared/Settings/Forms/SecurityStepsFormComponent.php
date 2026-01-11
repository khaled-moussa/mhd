<?php

namespace App\Livewire\Shared\Settings\Forms;

use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Livewire\Support\Traits\WithSteps;
use App\Support\Enums\FormStepEnum;
use App\Support\Rules\DifferentEmail;
use Livewire\Attributes\Locked;
use Livewire\Form;

class SecurityStepsFormComponent extends Form
{
    use WithLivewireExceptionHandling;
    use WithSteps;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    #[Locked]
    public string $currentEmail;

    public ?string $newEmail = null;
    public ?string $currentPassword = null;
    public ?string $otp = null;

    /*
    |-----------------------------
    | Validation Rules
    |-----------------------------
    */
    public function rulesForStep(): array
    {
        return match ($this->step) {

            FormStepEnum::PASSWORD_STEP => [
                'currentPassword' => [
                    'required',
                    'string',
                    'min:8',
                    'currentPassword',
                ],
            ],

            FormStepEnum::EMAIL_STEP => [
                'newEmail' => [
                    'required',
                    'email',
                    new DifferentEmail,
                    'unique:users,email',
                ],
            ],

            FormStepEnum::OTP_STEP => [
                'otp' => [
                    'required',
                    'digits:4',
                ],
            ],
        };
    }


    /*
    |-----------------------------
    | Sets
    |-----------------------------
    */
    public function setUserCurrentEmail(string $currentEmail): void
    {
        $this->currentEmail = $currentEmail;
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    public function resetForm(): void
    {
        $this->reset([
            'newEmail',
            'currentPassword',
            'otp'
        ]);
        
        $this->resetSteps();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
