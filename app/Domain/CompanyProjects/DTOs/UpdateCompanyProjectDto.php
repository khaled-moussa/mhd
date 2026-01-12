<?php

namespace App\Domain\CompanyProjects\DTOs;

class UpdateCompanyProjectDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string  $uuid,
        public string  $title,
        public ?string $description = null,
        public ?string $deliveredAt = null,
        public ?float  $priceStart = null,
        public ?string $address = null,
        public ?string $location = null,
        public ?array  $images = null,
    ) {}

    /**
     * Convert the DTO to an array.
     */
    public function toArray(): array
    {
        return array_filter(
            [
                'title'            => $this->title,
                'description'      => $this->description,
                'delivered_at'     => $this->deliveredAt,
                'price_start'      => $this->priceStart,
                'address'          => $this->address,
                'location'         => $this->location,
                'images'           => $this->images,
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
