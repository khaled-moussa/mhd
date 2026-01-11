<?php

namespace App\Livewire\Panels\Admin\Users\Forms;

use App\Domain\Users\Actions\GetUserByUuidAction;
use App\Domain\Users\Actions\UpdateUserAction;
use App\Domain\Users\DTOs\UpdateUserDto;
use App\Domain\Users\Models\User;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UserFormUpdateComponent extends Component
{
    // use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    #[Locked]
    public string $userUuid;

    public UserFormComponent $form;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view('admin_livewire::users.forms.user-form-update-component');
    }

    /*
    |-----------------------------
    | Loading
    |-----------------------------
    */
    public function editUser(string $userUuid): void
    {
        $this->userUuid = $userUuid;

        if ($this->user) {
            $this->form->fillUser(user: $this->user);
        }
    }
    /*
    |-----------------------------
    | CRUD: Update
    |-----------------------------
    */
    public function handleSubmit(array $formData)
    {
        $this->form->roles = $formData['roles'] ?? [];

        $this->submit();
    }

    public function submit(): void
    {
        $this->validate();

        $updateDto = new UpdateUserDto(
            uuid: $this->userUuid,
            firstName: $this->form->firstName,
            lastName: $this->form->lastName,
            phone: $this->form->phone
        );

        $user = app(UpdateUserAction::class)
            ->execute(
                user: $this->user,
                dto: $updateDto
            );

        $user->syncRoles($this->form->roles);

        $this->resetForm();
        $this->dispatchUserUpdatedEvent();
    }

    /*
    |-----------------------------
    | Computed
    |-----------------------------
    */
    #[Computed]
    public function user(): ?User
    {
        if (!$this->userUuid) {
            return null;
        }

        return app(GetUserByUuidAction::class)
            ->execute(userUuid: $this->userUuid);
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
    private function dispatchUserUpdatedEvent(): void
    {
        $this->dispatch(EventsEnum::USER_UPDATED_EVENT);
    }
}
