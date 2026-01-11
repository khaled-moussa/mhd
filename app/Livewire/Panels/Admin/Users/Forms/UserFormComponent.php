<?php

namespace App\Livewire\Panels\Admin\Users\Forms;

use App\Domain\Users\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Form;

class UserFormComponent extends Form
{
    #[Locked]
    public string $userUuid = '';
    public string $firstName = '';
    public string $lastName  = '';
    public string $email     = '';
    public ?string $phone = null;
    public  $roles = [];

    protected function rules(): array
    {
        return [
            'firstName' => [
                'required',
                'string',
                'min:3'
            ],
            'lastName'  => [
                'required',
                'string',
                'min:3'
            ],
            'email'     => [
                'required',
                'email',
                'unique:users,email,' . $this->userUuid . ',uuid'
            ],
            'phone' => [
                'nullable',
                'unique:users,phone,' . $this->userUuid . ',uuid'
            ],
            'roles' => [
                'required',
                'array'
            ],
            'roles.*' => [
                'exists:roles,name'
            ],
        ];
    }

    public function fillUser(User $user): void
    {
        $this->resetForm();

        $this->userUuid  = $user->getUuid();
        $this->firstName = $user->getFirstName();
        $this->lastName  = $user->getLastName();
        $this->email     = $user->getEmail();
        $this->phone     = $user->getPhone();
        $this->roles     = $user->roles->pluck('name')->toArray();
    }

    public function resetForm(): void
    {
        $this->reset();
        $this->resetValidation();
    }
}
