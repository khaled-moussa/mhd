<?php

namespace App\Domain\Users\Models;

use App\Domain\Settings\Models\Setting;
use App\Domain\Users\Observers\UserObserver;
use App\Domain\Users\QueryBuilders\UserQueryBuilder;
use App\Panel\Enums\PanelEnum;
use App\Support\Traits\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\OneTimePasswords\Models\Concerns\HasOneTimePasswords;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasUuid, HasOneTimePasswords, Notifiable;

    /*
    |-------------------------------
    |  Properties
    |-------------------------------
    */
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'social_id' => 'hashed',
    ];

    /*
    |-------------------------------
    |  Query Builder
    |-------------------------------
    */
    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    /*
    |-------------------------------
    |  Relations
    |-------------------------------
    */
    public function setting(): HasOne
    {
        return $this->hasOne(Setting::class);
    }

    /*
    |-------------------------------
    |  Getters
    |-------------------------------
    */
    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function getPanelId(): string
    {
        return $this->panel_id;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function getSocialId(): ?string
    {
        return $this->social_id;
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
    public function panel(): PanelEnum
    {
        return PanelEnum::from($this->getPanelId());
    }

    public function isAdmin(): bool
    {
        return $this->panel() === PanelEnum::ADMIN;
    }

    public function isUser(): bool
    {
        return $this->panel() === PanelEnum::USER;
    }
}
