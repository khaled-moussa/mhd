<?php

namespace App\Domain\CompanyProjects\DTOs;

use App\Domain\CompanyProjects\States\VisibilityStates\VisibleState;
use App\Domain\CompanyProjects\States\VisibilityStates\NotVisibleState;

class CreateCompanyProjectDto
{
    /*
    |--------------------------------------------------------------------------
    | DTO
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public string $title,
        public string $description,
        public string $address,
        public float $priceStart = 0,
        public bool $visible = true,
        public ?string $location = null,
        public ?string $deliveredAt = null,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Transform to Array
    |--------------------------------------------------------------------------
    */

    public function toArray(): array
    {
        return array_filter([
            'title'        => $this->title,
            'description'  => $this->description,
            'price_start'  => $this->priceStart,
            'address'      => $this->address,
            'location'     => $this->location,
            'delivered_at' => $this->deliveredAt,
            'visibility_state' => $this->visible ? VisibleState::class : NotVisibleState::class,
        ], fn($value) => $value !== null);
    }
}