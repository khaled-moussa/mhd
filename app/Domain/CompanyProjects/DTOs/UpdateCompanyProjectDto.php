<?php

namespace App\Domain\CompanyProjects\DTOs;

class UpdateCompanyProjectDto
{
    /*
    |-------------------------------
    | DTO
    |-------------------------------
    */
    public function __construct(
        public string $uuid,
        public string $title,
        public ?string $description = null,
        public ?float $priceStart = null,
        public ?string $address = null,
        public ?string $location = null,
        public ?string $deliveredAt = null,
    ) {}

    /*
    |-------------------------------
    | Transform to Array
    |-------------------------------
    */
    public function toArray(): array
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'price_start' => $this->priceStart,
            'address' => $this->address,
            'location' => $this->location,
            'delivered_at' => $this->deliveredAt,
        ], fn ($value) => $value !== null);
    }
}