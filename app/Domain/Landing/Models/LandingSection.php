<?php

namespace App\Domain\Landing\Models;

use App\Domain\Landing\QueryBuilders\LandingSectionBuilder;
use App\Domain\Landing\VisibilityStates\VisibilityStates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class LandingSection extends Model
{
    use HasFactory, HasStates;

    /*
    |-------------------------------
    |  Properties
    |-------------------------------
    */
    protected $guarded = [];

    protected $casts = [
        'visibility_state' => VisibilityStates::class,
        'data' => 'array',
    ];

    /*
    |-------------------------------
    |  Query Builder
    |-------------------------------
    */
    public function newEloquentBuilder($query): LandingSectionBuilder
    {
        return new LandingSectionBuilder($query);
    }

    /*
    |-------------------------------
    |  Attributes
    |-------------------------------
    */
    public function getKeyAttribute($value): string
    {
        return strtolower($value);
    }

    /*
    |-------------------------------
    |  Getters
    |-------------------------------
    */
    public function getKey(): string
    {
        return $this->key;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getVisibility(): VisibilityStates
    {
        return $this->visibility_state;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    /*
    |-------------------------------
    |  Getters Helpers
    |-------------------------------
    */
    public function isVisible(): bool
    {
        return (bool) $this->visibility_state->getValue();
    }
}
