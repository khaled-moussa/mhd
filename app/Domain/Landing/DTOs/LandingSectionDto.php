<?php

namespace App\Domain\Landing\DTOs;

use App\Domain\Landing\VisibilityStates\NotVisibleState;
use App\Domain\Landing\VisibilityStates\VisibleState;
use Illuminate\Support\Str;

class LandingSectionDto
{
    public function __construct(
        public string $key,
        public ?string $uuid = null,
        public ?string $title = null,
        public ?string $description = null,
        public bool $visible = true,
        public ?int $order = null,
        public array $data = [],
    ) {}

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid ?? Str::uuid(),
            'key' => $this->key,
            'title' => $this->title,
            'description' => $this->description,
            'visibility_state' => $this->visible ? VisibleState::class : NotVisibleState::class,
            'order' => $this->order,
            'data' => json_encode($this->data),
        ];
    }
}
