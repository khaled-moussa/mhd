<?php

namespace App\Domain\Landing\DTOs;

use App\Domain\Landing\VisibilityStates\VisibleState;
use App\Domain\Landing\VisibilityStates\NotVisibleState;

final class UpdateLandingSectionDto
{
    public function __construct(
        public string $key,
        public string $title,
        public string $description,
        public bool $visible,
        public ?int $order = null,
        public array $data = [],
    ) {}

    public function toArray(): array
    {
        return array_filter(
            [
                'key'               => $this->key,
                'title'             => $this->title,
                'description'       => $this->description,
                'visibility_state'  => $this->resolveVisiblity(),
                'order'             => $this->order,
                'data'              => $this->resolveData(),
            ],
            fn($value) => ! is_null($value) && $value !== ''
        );
    }

    protected function resolveVisiblity()
    {
        return $this->visible
            ? VisibleState::class
            : NotVisibleState::class;
    }

    protected function resolveData()
    {
        return json_encode($this->data);
    }
}
