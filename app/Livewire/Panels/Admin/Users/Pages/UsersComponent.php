<?php

namespace App\Livewire\Panels\Admin\Users\Pages;

use App\App\Web\Resources\Users\UsersResource;
use App\Domain\Roles\Actions\GetRolesAction;
use App\Domain\Users\Actions\DeleteUserAction;
use App\Domain\Users\Actions\GetUserByUuidAction;
use App\Domain\Users\Actions\GetUsersAction;
use App\Domain\Users\Models\User;
use App\Livewire\Panels\Admin\Users\Forms\UserFormComponent;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use App\Support\Traits\HandlePaginationButtons;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithLivewireExceptionHandling;
    use WithPagination;
    use HandlePaginationButtons;

    /* 
    |-----------------------------
    | Properties
    |----------------------------- 
    */
    public UserFormComponent $form;

    public array $defaultRoles = [];

    /* 
    |-----------------------------
    | Lifecycle
    |----------------------------- 
    */
    public function mount()
    {
        $this->defaultRoles = $this->availableRoles;
    }

    public function render()
    {
        $this->initPaginationButtons($this->users);

        $this->availableRoles;
        return view('admin_livewire::users.pages.users-component', [
            'paginator' => $this->users,
            'usersData' => $this->usersData,
        ]);
    }

    /* 
    |-----------------------------
    | Computed Properties
    |----------------------------- 
    */
    #[Computed]
    public function users()
    {
        return app(GetUsersAction::class)
            ->execute();
    }

    #[Computed]
    public function usersData(): array
    {
        return UsersResource::collection(
            $this->users->items()
        )->resolve();
    }


    #[Computed]
    public function availableRoles(): array
    {
        return app(GetRolesAction::class)
            ->execute()
            ->toArray();
    }


    /* 
    |-----------------------------
    | Actions
    |----------------------------- 
    */
    public function viewUser(string $userUuid): void
    {
        $user = $this->getUser($userUuid);

        if ($user) {
            $this->form->fillUser(user: $user);
        }
    }

    public function deleteUser(string $userUuid): void
    {
        $user = $this->getUser($userUuid);

        app(DeleteUserAction::class)
            ->execute(user: $user);

        // If current page becomes empty → go back
        if ($this->users->count() === 0 && $this->currentPage > 1) {
            $this->previousPage();
        }

        $this->dispatchUserDeletedEvent();
    }

    /* 
    |-----------------------------
    | Event Listeners
    |----------------------------- 
    */
    #[On(EventsEnum::USER_CREATED_EVENT->value)]
    public function handleUserCreated(): void
    {
        $this->resetPage();
    }

    #[On(EventsEnum::USER_UPDATED_EVENT->value)]
    public function handleUserUpdated(): void
    {
        // re-render only (computed will refresh automatically)
    }

    /* 
    |-----------------------------
    | Helpers
    |----------------------------- 
    */
    private function getUser(string $userUuid): ?User
    {
        return app(GetUserByUuidAction::class)
            ->execute(userUuid: $userUuid);
    }

    /* 
    |-----------------------------
    | Dispatchers
    |----------------------------- 
    */
    private function dispatchUserDeletedEvent(): void
    {
        $this->dispatch(EventsEnum::USER_DELETED_EVENT);
    }
}
