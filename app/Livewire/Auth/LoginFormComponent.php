<?php

namespace App\Livewire\Auth;

use App\Domain\Auth\Actions\AttemptToLoginAction;
use App\Domain\Auth\Actions\LogoutUserAction;
use App\Domain\Auth\Actions\PanelResolverAction;
use App\Domain\Auth\Exceptions\FailedToLoginException;
use App\Livewire\Support\Traits\ResetFormValidation;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\FormEnum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginFormComponent extends Component
{
    // use WithLivewireExceptionHandling;
    use ResetFormValidation;

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
    public function submit(): void
    {
        try {
            $this->validate();

            $user = app(AttemptToLoginAction::class)->execute(
                email: $this->email,
                password: $this->password,
            );

            app(LogoutUserAction::class)->execute();

            Auth::login($user, $this->remember);

            $this->resetForm();
            $this->redirect(PanelResolverAction::panelRoute($user));
        } catch (FailedToLoginException $e) {
            $this->addError('login_failed', $e->getMessage());
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
            'email',
            'password',
            'remember'
        ]);

        $this->resetValidation();
        $this->resetErrorBag();
        $this->dispatchResetFormValidation(FormEnum::LOGIN_FORM->value);
    }
}
