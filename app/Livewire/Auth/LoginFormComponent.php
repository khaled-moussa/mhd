<?php

namespace App\Livewire\Auth;

use App\Domain\Auth\Actions\AttemptToLoginAction;
use App\Domain\Auth\Actions\LogoutCurrentUserAction;
use App\Domain\Auth\Actions\SetTwoFactorSessionStateAction;
use App\Domain\Auth\Exceptions\FailedToLoginException;
use App\Domain\Users\Actions\RedirectToDashboardRouteAction;
use App\Domain\Users\Models\User;
use App\Domain\Users\Services\UserEmailRequestService;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginFormComponent extends Component
{
    use WithLivewireExceptionHandling;

    /*
    |-------------------------------
    | Properties
    |-------------------------------
    */
    public string $email;
    public string $password;
    public bool $remember = false;

    /*
    |-------------------------------
    | Lifecycle
    |-------------------------------
    */
    public function render()
    {
        return view('livewire.auth.login-form-component');
    }

    public function handleKnownExceptions($e, $stopPropagation): bool
    {
        if ($e instanceof FailedToLoginException) {
            $this->handleLoginException($e, $stopPropagation);
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
                'email',
                'max:255',
                'regex:/^[\w.+\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/'
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'max:32',
            ],

            'remember' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    /*
    |-------------------------------
    | Actions
    |-------------------------------
    */
    public function attemptLogin(): void
    {
        $this->validate();

        $user = app(AttemptToLoginAction::class)
            ->execute(
                email: $this->email,
                password: $this->password,
            );

        $this->handleTwoFactor(user: $user);

        app(LogoutCurrentUserAction::class)->execute();

        Auth::login($user, $this->remember);

        $redirectRoute = app(RedirectToDashboardRouteAction::class)
            ->execute(user: $user);

        $this->resetForm();
        $this->dispatchLoginSuccessEvent();

        $this->redirectRoute($redirectRoute);
    }

    /*
    |-------------------------------
    | Helpers
    |-------------------------------
    */
    private function handleTwoFactor(User $user)
    {
        $setting = $user->loadMissing('setting')->getRelation('setting');

        if ($setting->isTwoFactorEnabled()) {
            app(UserEmailRequestService::class)
                ->verifyTwoFactorRequest(user: $user);

            app(SetTwoFactorSessionStateAction::class)
                ->execute(state: true);
        }
    }

    private function resetForm(): void
    {
        $this->reset([
            'email',
            'password',
            'remember'
        ]);

        $this->resetValidation();
        $this->resetErrorBag();
    }

    /* 
    |-------------------------------
    | Exception Handlers
    |------------------------------- 
    */
    private function handleLoginException(FailedToLoginException $e, callable $stop): void
    {
        $this->addError('login_failed', $e->getMessage());
        $stop();
    }

    /*
    |-------------------------------
    | Dispatchers
    |-------------------------------
    */
    private function dispatchLoginSuccessEvent(): void
    {
        $this->dispatch(EventsEnum::LOGIN_SUCCESS_EVENT);
    }
}
