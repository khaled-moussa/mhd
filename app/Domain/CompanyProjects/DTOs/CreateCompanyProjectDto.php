<?php

namespace App\Domain\CompanyProjects\DTOs;

class CreateCompanyProjectDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string  $title,
        public string  $description,
        public float   $priceStart = 0,
        public string  $address,
        public ?string $location = null,
        public ?string $deliveredAt = null,
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
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
