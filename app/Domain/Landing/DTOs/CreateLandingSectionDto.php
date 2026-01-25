<?php

namespace App\Domain\Landing\DTOs;

use App\Domain\Landing\VisibilityStates\VisibleState;
use App\Domain\Landing\VisibilityStates\NotVisibleState;
use Illuminate\Support\Str;

final class CreateLandingSectionDto
{
    public function __construct(
        public string $key,
        public string $title,
        public string $description,
        public bool $visible,

        public ?string $label = null,
        public ?string $url = null,
        public ?string $uuid = null,
        public ?int $order = null,

        public array $data = [],
    ) {}

    public function toArray(): array
    {
        return [
            'uuid'              => $this->resolveUuid(),
            'key'               => $this->key,
            'label'             => $this->label,
            'title'             => $this->title,
            'description'       => $this->description,
            'url'               => $this->url,
            'visibility_state'  => $this->resolveVisiblity(),
            'order'             => $this->order,
            'data'              => $this->resolveData(),
        ];
    }


    protected function resolveUuid()
    {
        return $this->uuid ?? Str::uuid();
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
