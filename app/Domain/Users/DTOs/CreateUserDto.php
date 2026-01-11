<?php

namespace App\Domain\Users\DTOs;

class CreateUserDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string $firstName,
        public string $email,
        public ?string $lastName = null,
        public ?string $phone = null,
        public ?string $position = null,
        public ?string $companyName = null,
        public ?string $country = null,
        public ?string $city = null,
        public ?string $postalCode = null,
        public ?string $password = null,
        public ?string $provider = null,
        public ?string $socialId = null,
    ) {}

    /**
     * Convert the DTO to an array.
     */
    public function toArray(): array
    {
        return array_filter(
            [
                'first_name'   => $this->firstName,
                'last_name'    => $this->lastName,
                'email'        => $this->email,
                'phone'        => $this->phone,
                'position'     => $this->position,
                'company_name' => $this->companyName,
                'country'      => $this->country,
                'city'         => $this->city,
                'postal_code'  => $this->postalCode,
                'password'     => $this->password,
                'provider'     => $this->provider,
                'social_id'    => $this->socialId
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
