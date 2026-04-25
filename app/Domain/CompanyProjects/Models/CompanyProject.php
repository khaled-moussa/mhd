<?php

namespace App\Domain\CompanyProjects\Models;

use App\Domain\CompanyProjects\QueryBuilders\CompanyProjectBuilder;
use App\Domain\CompanyProjects\States\VisibilityStates\VisibilityStates;
use App\Support\Traits\HasUuid;
use App\Support\Traits\ResolveMediaToArray;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CompanyProject extends Model implements HasMedia
{
    use HasFactory;
    use HasStates;
    use HasUuid;
    use InteractsWithMedia;
    use ResolveMediaToArray;

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
    public function newEloquentBuilder($query): CompanyProjectBuilder
    {
        return new CompanyProjectBuilder($query);
    }

    /*
    |-------------------------------
    |  Spatie Media
    |-------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        
        $this->addMediaCollection('file')->singleFile();
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

    public function getImages(): array
    {
        return $this->mediaArray('images');
    }

    public function getImageCover(): string
    {
        return $this->getFirstMediaUrl('images');
    }

    public function getBorchure(): ?array
    {
        return $this->firstMediaData('file');
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
        return $this->visibility_state->value();
    }

    public function isHidden(): bool
    {
        return !$this->isVisible();
    }
}
