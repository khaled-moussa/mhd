<?php

namespace App\Livewire\Auth;

use App\Domain\Auth\Actions\SetTwoFactorSessionStateAction;
use App\Domain\Auth\Actions\LogoutCurrentUserAction;
use App\Domain\Users\Actions\GetCurrentUserAction;
use App\Domain\Users\Models\User;
use App\Domain\Users\Otp\TwoFactorOtpFlow;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Livewire\Support\Traits\WithOtp;
use App\Support\Enums\EventsEnum;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Throwable;

class TwoFactorFormComponent extends Component
{
    use WithLivewireExceptionHandling,
        WithRateLimiting,
        WithOtp;

    /* 
    |-------------------------------
    | Properties
    |------------------------------- 
    */
    public ?User $user = null;

    #[Locked]
    public string $email;

    public ?string $otp = null;

    /* 
    |-------------------------------
    | Lifecycle
    |------------------------------- 
    */
    public function mount(): void
    {
        $this->user  = app(GetCurrentUserAction::class)->execute();
        $this->email = $this->user->getEmail();
    }

    public function render()
    {
        return view('livewire.auth.two-factor-form-component');
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
    | Validation
    |------------------------------- 
    */
    protected function rules(): array
    {
        return [
            'otp' => ['required', 'digits:4'],
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

        $this->verifyOtp(
            flow: $this->otpFlow(),
            otp: $this->otp
        );

        app(SetTwoFactorSessionStateAction::class)->execute(state: false);

        $this->resetForm();
        $this->dispatchTwoFactorSuccessEvent();

        $this->redirectRoute('admin.dashboard');
    }

    public function sendOtp(): void
    {
        $this->sendOtpFlow($this->otpFlow());
    }

    public function logout(): void
    {
        app(LogoutCurrentUserAction::class)->execute();

        app(SetTwoFactorSessionStateAction::class)->execute(state: false);

        $this->resetForm();

        $this->redirectRoute('auth.login');
    }

    /* 
    |-------------------------------
    | Helpers
    |------------------------------- 
    */
    private function resetForm(): void
    {
        $this->reset(['otp']);
        $this->resetValidation();
        $this->resetErrorBag();
    }

    private function otpFlow(): TwoFactorOtpFlow
    {
        return app(TwoFactorOtpFlow::class);
    }

    /* 
    |-------------------------------
    | Exception Handlers
    |------------------------------- 
    */
    private function handleOtpException(Throwable $e, callable $stop): void
    {
        $this->addError('otp', $e->getMessage());

        $this->dispatchOtpErrorEvent(
            exception: class_basename($e),
            message: $e->getMessage()
        );

        $stop();
    }

    /* 
    |-------------------------------
    | Dispatchers
    |------------------------------- 
    */
    private function dispatchTwoFactorSuccessEvent(): void
    {
        $this->dispatch(EventsEnum::TWO_FACTOR_SUCCESS_EVENT->value);
    }
}
