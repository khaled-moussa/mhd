<?php

namespace App\Domain\Contacts\DTOs;

class CreateContactDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $message,
        public ?string $phone = null,
    ) {}

    /**
     * Convert the DTO to an array.
     */
    public function toArray(): array
    {
        return array_filter(
            [
                'name'    => $this->name,
                'email'   => $this->email,
                'phone'   => $this->phone,
                'message' => $this->message,
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
