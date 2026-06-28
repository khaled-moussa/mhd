<?php

namespace App\Domain\CompanyServices\Models;

use App\App\Web\Resources\CompanyServices\CompanyServicesResource;
use App\Domain\CompanyServices\QueryBuilders\CompanyServiceBuilder;
use App\Domain\CompanyServices\States\VisibilityStates\VisibilityStates;
use App\Support\Traits\HasUuid;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

#[UseResource(CompanyServicesResource::class)]
class CompanyService extends Model
{
    use HasFactory, HasStates, HasUuid;

    /*
    |-------------------------------
    |  Properties
    |-------------------------------
    */
    protected $guarded = [];

    protected $casts = [
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getIconClass(): ?string
    {
        if (! $this->icon) return null;

        return "<i class=\"{$this->icon}\"></i>";
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
