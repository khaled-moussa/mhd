<?php

namespace App\Livewire\Shared\Settings\Forms;

use App\Domain\Users\Actions\UpdateUserEmailAction;
use App\Domain\Users\Exceptions\InvalidNewEmailArgumentException;
use App\Domain\Users\Otp\VerifyNewEmailOtpFlow;
use App\Livewire\Shared\Settings\Bases\BaseSettingComponent;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Livewire\Support\Traits\WithOtp;
use App\Support\Enums\EventsEnum;
use App\Support\Enums\FormStepEnum;
use Throwable;

class UpdateEmailFormComponent extends BaseSettingComponent
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
        return view('livewire.shared.settings.forms.update-email-form-component');
    }

    public function handleKnownExceptions(Throwable $e, callable $stop): bool
    {
        if ($e instanceof InvalidNewEmailArgumentException) {
            $this->handleEmailException($e, $stop);
            return true;
        }

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
            FormStepEnum::EMAIL_STEP => $this->afterEmailVerified(),
            FormStepEnum::OTP_STEP => $this->afterOtpVerified(),
        };
    }

    private function afterPasswordVerified(): void
    {
        $this->nextStep(FormStepEnum::EMAIL_STEP);
    }

    private function afterEmailVerified(): void
    {
        $this->nextStep(FormStepEnum::OTP_STEP);
        $this->sendOtp();
    }

    private function afterOtpVerified(): void
    {
        $this->verifyOtp(
            flow: app(VerifyNewEmailOtpFlow::class),
            otp: $this->form->otp
        );

        app(UpdateUserEmailAction::class)->execute(
            user: $this->user,
            email: $this->form->newEmail
        );

        $this->form->setUserCurrentEmail(currentEmail: $this->form->newEmail);

        $this->dispatchUserEmailUpdatedEvent();
        $this->resetForm();
    }

    public function sendOtp(): void
    {
        if (!in_array($this->form->step, [FormStepEnum::EMAIL_STEP, FormStepEnum::OTP_STEP])) {
            return;
        }

        $this->sendOtpFlow(
            app(VerifyNewEmailOtpFlow::class),
            ['newEmail' => $this->form->newEmail]
        );
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
    private function handleEmailException(Throwable $e, callable $stop): void
    {
        $this->addError('form.newEmail', $e->getMessage());
        $stop();
    }

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

    private function dispatchUserEmailUpdatedEvent(): void
    {
        $this->dispatch(
            EventsEnum::USER_EMAIL_UPDATED_EVENT->value,
            message: 'Your email has been updated successfully.'
        );
    }
}
