<?php

namespace App\App\Web\Resources\SiteEditors;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteEditorsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'key'         => $this->getKey(),
            'title'       => $this->getTitle(),
            'description' => $this->getDescription(),
            'visible'     => $this->getVisibility()->value(),
            'order'       => $this->getOrder(),
            'data'        => $this->getData(),
        ];
    }
}