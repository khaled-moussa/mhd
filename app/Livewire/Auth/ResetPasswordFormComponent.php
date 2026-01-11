<?php

namespace App\Livewire\Auth;

use App\Domain\Auth\Actions\AttemptToChangePasswordAction;
use App\Domain\Auth\Exceptions\PasswordResetTokenExpiredException;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ResetPasswordFormComponent extends Component
{
    use WithLivewireExceptionHandling;

    /*
    |-------------------------------
    | Properties
    |-------------------------------
    */
    #[Locked]
    public string $token;

    #[Locked]
    public string $email;

    public string $newPassword;
    public string $passwordConfirmation;

    /*
    |-------------------------------
    | Lifecycle
    |-------------------------------
    */
    public function mount(string $email, string $token): void
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function render()
    {
        return view('livewire.auth.reset-password-form-component');
    }

    public function handleKnownExceptions($e, $stopPropagation): bool
    {
        if ($e instanceof PasswordResetTokenExpiredException) {
            $this->handleResetPasswordException($e, $stopPropagation);
            return true;
        }

        return false;
    }

    /*
    |-------------------------------
    | Validation
    |-------------------------------
    */
    protected function rules(): array
    {
        return [
            'email' => [
                'required',
                'email:filter'
            ],

            'newPassword' => [
                'required',
                'string',
                'min:8',
                'max:32',
                'different:currentPassword',
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
    public function attemptToChangePassword(): void
    {
        $this->validate();

        app(AttemptToChangePasswordAction::class)->execute(
            email: $this->email,
            newPassword: $this->newPassword,
            token: $this->token
        );

        $this->resetForm();
        $this->dispatchResetPasswordSuccessEvent();

        $this->redirectRoute('auth.login');
    }

    /*
    |-------------------------------
    | Helpers
    |-------------------------------
    */
    private function resetForm(): void
    {
        $this->reset([
            'email',
            'newPassword',
            'passwordConfirmation',
        ]);

        $this->resetValidation();
        $this->resetErrorBag();
    }

    /* 
    |-------------------------------
    | Exception Handlers
    |------------------------------- 
    */
    private function handleResetPasswordException(PasswordResetTokenExpiredException $e, callable $stop): void
    {
        $this->addError('reset_password_failed', $e->getMessage());
        $stop();
    }

    /*
    |-------------------------------
    | Dispatch Events
    |-------------------------------
    */
    private function dispatchResetPasswordSuccessEvent(): void
    {
        $this->dispatch(EventsEnum::RESET_PASSWORD_SUCCESS_EVENT);
    }
}
