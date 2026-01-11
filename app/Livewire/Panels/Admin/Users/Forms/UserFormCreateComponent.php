<?php

namespace App\Livewire\Panels\Admin\Users\Forms;

use App\Domain\Users\Actions\CreateUserAction;
use App\Domain\Users\DTOs\CreateUserDto;
use App\Domain\Users\Services\UserEmailRequestService;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Component;

class UserFormCreateComponent extends Component
{
    // use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    public UserFormComponent $form;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view('admin_livewire::users.forms.user-form-create-component');
    }

    /*
    |-----------------------------
    | CRUD: Create or Update
    |-----------------------------
    */
    public function handleSubmit(array $formData)
    {
        $this->form->roles = $formData['roles'] ?? [];

        $this->submit();
    }

    public function submit(): void
    {
        $this->form->validate();

        $createDto = new CreateUserDto(
            firstName: $this->form->firstName,
            lastName: $this->form->lastName,
            email: $this->form->email,
            phone: $this->form->phone,
        );

        $user = app(CreateUserAction::class)
            ->execute(dto: $createDto);

        $user->syncRoles($this->form->roles);

        app(UserEmailRequestService::class)
            ->resetPasswordRequest($user);

        $this->resetForm();
        $this->dispatchUserCreatedEvent();
    }
    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    private function resetForm()
    {
        $this->form->resetForm();
    }

    /*
    |-----------------------------
    | Events
    |-----------------------------
    */
    private function dispatchUserCreatedEvent(): void
    {
        $this->dispatch(EventsEnum::USER_CREATED_EVENT);
    }
}
