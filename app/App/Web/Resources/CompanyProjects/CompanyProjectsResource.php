<?php

namespace App\App\Web\Resources\CompanyProjects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProjectsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'        => $this->getUuid(),
            'icon'        => $this->getIcon(),
            'title'       => $this->getTitle(),
            'description' => $this->getDescription(),
            'visible'     => $this->getVisibility()->getValue(), // Return true or false
            'created_at'  => $this->getCreatedAt(),
            'updated_at'  => $this->getUpdatedAt(),
        ];
    }
}
