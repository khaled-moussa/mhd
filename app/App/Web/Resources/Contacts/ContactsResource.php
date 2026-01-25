<?php

namespace App\App\Web\Resources\Contacts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'        => $this->getUuid(),
            'name'        => $this->getName(),
            'email'       => $this->getEmail(),
            'phone'       => $this->getPhone(),
            'message'     => $this->getMessage(),
            'created_at'  => $this->getCreatedAt(),
            'updated_at'  => $this->getUpdatedAt(),
        ];
    }
}
