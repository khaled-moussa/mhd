<?php

namespace App\Domain\CompanyProjects\Models;

use App\Domain\CompanyProjects\States\VisibilityStates\VisibilityStates;
use App\Domain\CompanyServices\QueryBuilders\CompanyServiceBuilder;
use App\Support\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CompanyProject extends Model implements HasMedia
{
    use HasFactory, HasStates, HasUuid;
    use InteractsWithMedia;


    /*
    |-------------------------------
    |  Properties
    |-------------------------------
    */
    protected $guarded = [];

    protected $casts = [
        'images'           => 'array',
        'visibility_state' => VisibilityStates::class,
    ];

    /*
    |-------------------------------
    |  Query Builder
    |-------------------------------
    */
    public function newEloquentBuilder($query): CompanyServiceBuilder
    {
        return new CompanyServiceBuilder($query);
    }

    /*
    |-------------------------------
    |  Spatie Media
    |-------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    /*
    |-------------------------------
    |  Getters
    |-------------------------------
    */
    public function getId(): string
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getImages(): ?array
    {
        return $this->media->map(function ($media) {
            return [
                'id' => $media->id,
                'path' => $media->getUrl(),
            ];
        })->toArray();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPriceStart(): float
    {
        return $this->price_start;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function getVisibility(): VisibilityStates
    {
        return $this->visibility_state;
    }

    public function getDeliveredAt(): ?string
    {
        return $this->delivered_at;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
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

    public function isHidden(): bool
    {
        return ! $this->isVisible();
    }
}
