<?php

namespace App\Domain\CompanyServices\DTOs;

class CreateCompanyServiceDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string $title,
        public ?string $description = null,
    ) {}

    /**
     * Convert the DTO to an array.
     */
    public function toArray(): array
    {
        return array_filter(
            [
                'title'       => $this->title,
                'description' => $this->description,
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
