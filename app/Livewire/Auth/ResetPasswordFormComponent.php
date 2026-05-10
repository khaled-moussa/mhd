<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Support\Enums\EventsEnum;
use App\Domain\Auth\Actions\AttemptToChangePasswordAction;
use App\Domain\Auth\Exceptions\PasswordResetTokenExpiredException;

class ResetPasswordFormComponent extends Component
{
    /*
    |-------------------------------
    | Locked Properties
    |-------------------------------
    */
    #[Locked]
    public string $token;

    #[Locked]
    public string $email;

    /*
    |-------------------------------
    | Form Fields
    |-------------------------------
    */
    public string $newPassword = '';
    public string $passwordConfirmation = '';

    /*
    |-------------------------------
    | Lifecycle
    |-------------------------------
    */
    public function mount(string $email, string $token): void
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function render()
    {
        return view('livewire.auth.reset-password-form-component');
    }

    /*
    |-------------------------------
    | Validation Rules
    |-------------------------------
    */
    protected function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],

            'newPassword' => [
                'required',
                'string',
                'min:8',
                'max:32',
            ],

            'passwordConfirmation' => [
                'required',
                'same:newPassword',
                'string',
                'min:8',
                'max:32',
            ],
        ];
    }

    /*
    |-------------------------------
    | Actions
    |-------------------------------
    */
    public function submit(): void
    {
        $this->validate();

        try {
            app(AttemptToChangePasswordAction::class)->execute(
                email: $this->email,
                newPassword: $this->newPassword,
                token: $this->token
            );

            $this->resetForm();
            $this->dispatchResetPasswordSuccessEvent();

            $this->redirectRoute('auth.login');
        } catch (PasswordResetTokenExpiredException $e) {
            $this->addError('reset_failed', $e->getMessage());
            return;
        } catch (\Throwable) {
            $this->redirectRoute('auth.login');
        }
    }

    /*
    |-------------------------------
    | Helpers
    |-------------------------------
    */
    private function resetForm(): void
    {
        $this->reset([
            'newPassword',
            'passwordConfirmation',
        ]);

        $this->resetValidation();
        $this->resetErrorBag();
    }

    /*
    |-------------------------------
    | Events
    |-------------------------------
    */
    private function dispatchResetPasswordSuccessEvent(): void
    {
        $this->dispatch(EventsEnum::RESET_PASSWORD_SUCCESS_EVENT);
    }
}
