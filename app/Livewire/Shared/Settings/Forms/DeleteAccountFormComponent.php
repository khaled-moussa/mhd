<?php

namespace App\Livewire\Shared\Settings\Forms;

use App\Domain\Auth\Actions\LogoutCurrentUserAction;
use App\Domain\Users\Actions\DeleteUserAccountAction;
use App\Domain\Users\Otp\AccountDeletionOtpFlow;
use App\Livewire\Shared\Settings\Bases\BaseSettingComponent;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Livewire\Support\Traits\WithOtp;
use App\Support\Enums\EventsEnum;
use App\Support\Enums\FormStepEnum;
use Throwable;

class DeleteAccountFormComponent extends BaseSettingComponent
{
    use WithLivewireExceptionHandling;
    use WithOtp;

    /* 
    |-------------------------------
    | Properties
    |------------------------------- 
    */
    public SecurityStepsFormComponent $form;

    /* 
    |-------------------------------
    | Lifecycle
    |------------------------------- 
    */
    public function mount(): void
    {
        $this->form->setUserCurrentEmail(currentEmail: $this->user->getEmail());
    }

    public function render()
    {
        return view('livewire.shared.settings.forms.delete-account-form-component');
    }

    public function handleKnownExceptions(Throwable $e, callable $stop): bool
    {
        if ($this->handleOtpKnownExceptions($e, $stop)) {
            return true;
        }

        return false;
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
            FormStepEnum::OTP_STEP => $this->afterOtpVerified(),
        };
    }

    private function afterPasswordVerified(): void
    {
        $this->sendOtp();
        $this->nextStep(FormStepEnum::OTP_STEP);
    }

    private function afterOtpVerified(): void
    {
        $this->verifyOtp(
            flow: app(AccountDeletionOtpFlow::class),
            otp: $this->form->otp
        );

        app(DeleteUserAccountAction::class)
            ->execute(
                user: $this->user,
            );

        $this->dispatchUserAccountDeletedEvent();
        $this->resetForm();

        $this->nextStep(FormStepEnum::ACCOUNT_DELETED);
    }

    public function logout(): void
    {
        app(LogoutCurrentUserAction::class)->execute();

        $this->resetForm();
        $this->redirectRoute('auth.login');
    }

    public function sendOtp(): void
    {
        if (!in_array($this->form->step, [FormStepEnum::PASSWORD_STEP, FormStepEnum::OTP_STEP])) {
            return;
        }

        $this->sendOtpFlow(app(AccountDeletionOtpFlow::class));
    }

    /* 
    |-------------------------------
    | Helpers
    |------------------------------- 
    */
    private function nextStep(FormStepEnum $step): void
    {
        $this->form->setStep($step);
        $this->dispatchStepNextEvent();
    }

    public function resetForm(): void
    {
        $this->form->resetForm();
    }

    /* 
    |-------------------------------
    | Exception Handlers
    |------------------------------- 
    */
    private function handleOtpException(Throwable $e, callable $stop): void
    {
        $this->addError('form.otp', $e->getMessage());
        $this->dispatchOtpErrorEvent(exception: class_basename($e), message: $e->getMessage());
        $stop();
    }

    /* 
    |-------------------------------
    | Dispatchers
    |------------------------------- 
    */
    private function dispatchStepNextEvent(): void
    {
        $this->dispatch(
            EventsEnum::STEP_NEXT_EVENT->value,
            step: $this->form->step->value
        );
    }

    private function dispatchUserAccountDeletedEvent(): void
    {
        $this->dispatch(
            EventsEnum::USER_ACCOUNT_DELETED_EVENT->value,
            message: 'Your account has been deleted successfully, See you later'
        );
    }
}
