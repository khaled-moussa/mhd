<?php

namespace App\Livewire\Auth;

use App\Domain\Auth\Actions\AttemptToResetPasswordAction;
use App\Domain\Auth\Exceptions\FailedToForgetPasswordException;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Component;

class ForgotPasswordFormComponent extends Component
{
    use WithLivewireExceptionHandling;

    /*
    |-------------------------------
    | Properties
    |-------------------------------
    */
    public string $email;

    /*
    |-------------------------------
    | Lifecycle
    |-------------------------------
    */
    public function render()
    {
        return view('livewire.auth.forgot-password-form-component');
    }

    public function handleKnownExceptions($e, $stopPropagation): bool
    {
        if ($e instanceof FailedToForgetPasswordException) {
            $this->handleForgetPasswordException($e, $stopPropagation);
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
            'email' => 'required|email:filter',
        ];
    }

    /*
    |-------------------------------
    | Actions
    |-------------------------------
    */
    public function attemptForgetPassword(): void
    {
        $this->validate();

        app(AttemptToResetPasswordAction::class)
            ->execute(
                email: $this->email,
            );

        $this->resetForm();
        $this->dispatchForgetPasswordSuccessEvent();

        $this->redirectRoute('auth.login');
    }

    /*
    |-------------------------------
    | Helpers
    |-------------------------------
    */
    private function resetForm(): void
    {
        $this->reset(['email']);
        $this->resetValidation();
        $this->resetErrorBag();
    }

    /* 
    |-------------------------------
    | Exception Handlers
    |------------------------------- 
    */
    private function handleForgetPasswordException(FailedToForgetPasswordException $e, callable $stop): void
    {
        $this->redirectRoute('auth.login');
        $this->dispatchForgetPasswordSuccessEvent();

        $stop();
    }

    /*
    |-------------------------------
    | Dispatch Events
    |-------------------------------
    */
    private function dispatchForgetPasswordSuccessEvent(): void
    {
        $this->dispatch(EventsEnum::FORGOT_PASSWORD_SUCCESS_EVENT, message: "Email sent successfully ");
    }
}
