<?php

namespace App\Domain\Contacts\Models;

use App\Support\Traits\HasUuid;
use Spatie\ModelStates\HasStates;
use App\Domain\Contacts\QueryBuilders\ContactQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    use HasStates;
    use HasUuid;

    /*
    |-------------------------------
    |  Properties
    |-------------------------------
    */
    protected $guarded = [];

    /*
    |-------------------------------
    |  Query Builder
    |-------------------------------
    */
    public function newEloquentBuilder($query): ContactQueryBuilder
    {
        return new ContactQueryBuilder($query);
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
