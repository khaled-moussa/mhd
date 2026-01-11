<?php

namespace App\Livewire\Shared\Settings\Pages;

use App\Domain\Users\Actions\UpdateUserAction;
use App\Domain\Users\DTOs\UpdateUserDto;
use App\Livewire\Shared\Settings\Bases\BaseSettingComponent;
use App\Support\Enums\EventsEnum;

class ProfileComponent extends BaseSettingComponent
{
    /*
    |-----------------------------
    | State
    |-----------------------------
    */
    public string $userUuid;
    public string $fullName;
    public string $firstName;
    public string $lastName;
    public ?string $phone = null;
    public ?string $position = null;
    public ?string $companyName = null;
    public ?string $country = null;
    public ?string $city = null;
    public ?string $postalCode = null;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function mount(): void
    {
        $this->fillFromUser();
    }

    public function render()
    {
        return view('livewire.shared.settings.pages.profile-component');
    }

    /*
    |-----------------------------
    | Validation
    |-----------------------------
    */
    protected function rules(): array
    {
        return [
            'firstName'   => [
                'required',
                'string',
                'max:255'
            ],
            'lastName'    => [
                'required',
                'string',
                'max:255'
            ],
            'phone'       => [
                'nullable',
                'string',
                'min:8',
                'unique:users,phone,' . $this->userUuid . ',uuid'
            ],
            'position'    => [
                'nullable',
                'string',
                'max:255'
            ],
            'companyName' => [
                'nullable',
                'string',
                'max:255'
            ],
            'country'     => [
                'nullable',
                'string',
                'max:255'
            ],
            'city'        => [
                'nullable',
                'string',
                'max:255'
            ],
            'postalCode'  => [
                'nullable',
                'string',
                'max:50'
            ],
        ];
    }

    /*
    |-----------------------------
    | Hydrate User Data
    |-----------------------------
    */
    private function fillFromUser(): void
    {
        $this->userUuid    = $this->user->getUuid();
        $this->fullName    = $this->user->getFullName();
        $this->firstName   = $this->user->getFirstName();
        $this->lastName    = $this->user->getLastName();
        $this->phone       = $this->user->getPhone();
        $this->position    = $this->user->getPosition();
        $this->companyName = $this->user->getCompanyName();
        $this->country     = $this->user->getCountry();
        $this->city        = $this->user->getCity();
        $this->postalCode  = $this->user->getPostalCode();
    }

    /*
    |-----------------------------
    | Update Profile
    |-----------------------------
    */
    public function submit(): void
    {
        $this->validate();

        $dto = new UpdateUserDto(
            uuid: $this->userUuid,
            firstName: $this->firstName,
            lastName: $this->lastName,
            phone: $this->phone,
            position: $this->position,
            companyName: $this->companyName,
            country: $this->country,
            city: $this->city,
            postalCode: $this->postalCode,
        );

        app(UpdateUserAction::class)
            ->execute(
                user: $this->user,
                dto: $dto
            );

        $this->dispatchUserProfileUpdatedEvent();
    }

    /*
    |-----------------------------
    | Dispatchers
    |-----------------------------
    */
    private function dispatchUserProfileUpdatedEvent()
    {
        $this->dispatch(EventsEnum::USER_PROFILE_UPDATED_EVENT);
    }
}
