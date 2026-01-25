<?php

namespace App\Domain\CompanyServices\DTOs;

use App\Domain\CompanyServices\States\VisibilityStates\NotVisibleState;
use App\Domain\CompanyServices\States\VisibilityStates\VisibleState;

class CreateCompanyServiceDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string $title,
        public ?string $description = null,
        public bool $visible = true,
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
                'visibility_state' => $this->visible ? VisibleState::class : NotVisibleState::class,
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
