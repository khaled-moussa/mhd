<?php

namespace App\App\Web\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'        => $this->getUuid(),
            'full_name'   => $this->getFullName(),
            'first_name'  => $this->getFirstName(),
            'last_name'   => $this->getLastName(),
            'email'       => $this->getEmail(),
            'phone'       => $this->getPhone(),

            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
