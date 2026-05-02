<?php

namespace App\Domain\CompanyProjects\DTOs;

class CreateCompanyProjectDto
{
    /*
    |-------------------------------
    | Create DTO
    |-------------------------------
    */
    public function __construct(
        public string $title,
        public string $description,
        public string $address,
        public float $priceStart = 0,
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
            'address' => $this->address,
            'price_start' => $this->priceStart,
            'location' => $this->location,
            'delivered_at' => $this->deliveredAt,
        ], fn($value) => $value !== null && $value !== '');
    }
}
