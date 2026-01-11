<?php

namespace App\Livewire\Auth;

use App\Domain\Auth\Actions\AttemptToRegisterAction;
use App\Domain\Auth\Exceptions\FailedToRegisterException;
use App\Domain\Users\DTOs\CreateUserDto;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Component;

class RegisterFormComponent extends Component
{
    use WithLivewireExceptionHandling;

    /*
    |-------------------------------
    | Properties
    |-------------------------------
    */
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $passwordConfirmation;
    public bool $acceptTermsAndPrivacy = false;

    /*
    |-------------------------------
    | Lifecycle
    |-------------------------------
    */
    public function render()
    {
        return view('livewire.auth.register-form-component');
    }

    public function handleKnownExceptions($e, $stopPropagation): bool
    {
        if ($e instanceof FailedToRegisterException) {
            $this->handleRegisterException($e, $stopPropagation);
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
            'firstName' => [
                'required',
                'string',
                'min:3',
                'max:75',
                'regex:/^[a-zA-Z\s\-]+$/'
            ],
            'lastName' => [
                'required',
                'string',
                'min:3',
                'max:75',
                'regex:/^[a-zA-Z\s\-]+$/'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[\w.+\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:32',
                'regex:/[a-z]/',       // at least one lowercase
                'regex:/[A-Z]/',       // at least one uppercase
                'regex:/\d/',          // at least one number
                'regex:/[@$!%*?&]/',   // at least one special character
            ],
            'passwordConfirmation' => [
                'required',
                'same:password',
                'string',
                'min:8',
                'max:32'
            ],
            'acceptTermsAndPrivacy' => [
                'required',
                'boolean',
                'accepted'
            ],
        ];
    }

    /*
    |-------------------------------
    | Actions
    |-------------------------------
    */
    public function attemptRegister(): void
    {
        $this->validate();

        $createUserDto = new CreateUserDto(
            firstName: $this->firstName,
            lastName: $this->lastName,
            email: $this->email,
            password: $this->password,
        );

        app(AttemptToRegisterAction::class)
            ->execute(
                dto: $createUserDto
            );

        $this->resetForm();
        $this->dispatchRegistredSuccessEvent();

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
            'firstName',
            'lastName',
            'email',
            'password',
            'passwordConfirmation',
            'acceptTermsAndPrivacy'
        ]);

        $this->resetValidation();
        $this->resetErrorBag();
    }

    /* 
    |-------------------------------
    | Exception Handlers
    |------------------------------- 
    */
    private function handleRegisterException(FailedToRegisterException $e, callable $stop): void
    {
        $this->addError('register_failed', $e->getMessage());
        $stop();
    }

    /*
    |-------------------------------
    | Dispatch Events
    |-------------------------------
    */
    private function dispatchRegistredSuccessEvent(): void
    {
        $this->dispatch(EventsEnum::REGISTER_SUCCESS_EVENT);
    }
}
