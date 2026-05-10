<?php

namespace App\Domain\CompanyProjects\DTOs;

class UpdateCompanyProjectDto
{
    /*
    |--------------------------------------------------------------------------
    | DTO
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public string $uuid,
        public string $title,
        public string $description,
        public float $priceStart,
        public string $address,
        public bool $visible = true,
        public ?string $location = null,
        public ?string $deliveredAt = null,
    ) {
        $this->location    = $this->resolveNullable($this->location);
        $this->deliveredAt = $this->resolveNullable($this->deliveredAt);
    }

    /*
    |--------------------------------------------------------------------------
    | Transform to Array
    |--------------------------------------------------------------------------
    */

    public function toArray(): array
    {
        return [
            'title'        => $this->title,
            'description'  => $this->description,
            'price_start'  => $this->priceStart,
            'address'      => $this->address,
            'location'     => $this->location,
            'delivered_at' => $this->deliveredAt,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function resolveNullable(?string $value): ?string
    {
        return blank($value) ? null : $value;
    }
}
