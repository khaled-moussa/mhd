<?php

namespace App\Domain\Users\DTOs;

class UpdateUserDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string $uuid,
        public string $firstName,
        public string $lastName,
        public ?string $password = null,
        public ?string $phone = null,
        public ?string $position = null,
        public ?string $companyName = null,
        public ?string $country = null,
        public ?string $city = null,
        public ?string $postalCode = null,
    ) {}

    /**
     * Convert the DTO to an array.
     */
    public function toArray(): array
    {
        return array_filter(
            [
                'uuid'         => $this->uuid,
                'first_name'   => $this->firstName,
                'last_name'    => $this->lastName,
                'phone'        => $this->phone,
                'password'     => $this->password,
                'position'     => $this->position,
                'company_name' => $this->companyName,
                'country'      => $this->country,
                'city'         => $this->city,
                'postal_code'  => $this->postalCode,
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
