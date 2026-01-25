<?php

namespace App\App\Web\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'        => $this->getUuid(),
            'full_name'   => $this->getFullName(),
            'email'       => $this->getEmail(),
        ];
    }
}
