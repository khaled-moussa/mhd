<?php

namespace App\Domain\CompanyProjects\Models;

use App\App\Web\Resources\CompanyProjects\CompanyProjectsResource;
use App\Domain\CompanyProjects\QueryBuilders\CompanyProjectBuilder;
use App\Domain\CompanyProjects\States\VisibilityStates\VisibilityStates;
use App\Domain\Landing\VisibilityStates\VisibleState;
use App\Support\Traits\HasUuid;
use Spatie\ModelStates\HasStates;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseResource(CompanyProjectsResource::class)]
class CompanyProject extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasStates;
    use HasUuid;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $guarded = [];

    protected $casts = [
        'images'           => 'array',
        'visibility_state' => VisibilityStates::class,
        'delivered_at' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Custom Query Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): CompanyProjectBuilder
    {
        return new CompanyProjectBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    |  Attributes
    |--------------------------------------------------------------------------
    */

    public function getImageCoverAttribute(): ?string
    {
        return $this->getFirstMediaUrl('images');
    }

    public function getBrochureAttribute(): ?array
    {
        $media = $this->getFirstMedia('brochure');

        return $media ? [
            'id'   => $media->id,
            'name' => $media->name,
            'url'  => $media->getUrl(),
        ] : null;
    }

    /*
    |--------------------------------------------------------------------------
    |  Media Register
    |--------------------------------------------------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('brochure')->singleFile();
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getId(): string
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImageCover(): string
    {
        return $this->image_cover;
    }

    public function getImages(): array
    {
        return $this->getMedia('images')
            ->map(function ($media) {
                return [
                    'id'   => $media->id,
                    'path' => $media->getUrl(),
                ];
            })
            ->values()
            ->toArray();
    }

    public function getBrochure(): ?array
    {
        return $this->brochure;
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

    public function getDeliveredAt(): ?int
    {
        return $this->delivered_at;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at->format('M d, Y h:i A');
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at->format('M d, Y h:i A');
    }

    /*
    |--------------------------------------------------------------------------
    | States
    |--------------------------------------------------------------------------
    */

    public function isVisible(): bool
    {
        return $this->getVisibility() === VisibleState::class;
    }

    public function isHidden(): bool
    {
        return !$this->isVisible();
    }
}
