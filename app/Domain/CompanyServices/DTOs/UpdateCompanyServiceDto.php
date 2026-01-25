<?php

namespace App\Domain\CompanyServices\DTOs;

use App\Domain\CompanyServices\States\VisibilityStates\NotVisibleState;
use App\Domain\CompanyServices\States\VisibilityStates\VisibleState;

class UpdateCompanyServiceDto
{
    /**
     * Create a new DTO instance.
     */
    public function __construct(
        public string $uuid,
        public string $title,
        public string $description,
        public ?string $icon = null,
        public bool $visible = true,
    ) {}

    /**
     * Convert the DTO to an array.
     */
    public function toArray(): array
    {
        return array_filter(
            [
                'uuid'        => $this->uuid,
                'icon'       => $this->icon,
                'title'       => $this->title,
                'description' => $this->description,
                'visibility_state' => $this->visible ? VisibleState::class : NotVisibleState::class,
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }
}
