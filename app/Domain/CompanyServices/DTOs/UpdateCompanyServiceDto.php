<?php

namespace App\Domain\CompanyServices\DTOs;

class UpdateCompanyServiceDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string $uuid,
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
                'uuid'        => $this->uuid,
                'title'       => $this->title,
                'description' => $this->description,
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
