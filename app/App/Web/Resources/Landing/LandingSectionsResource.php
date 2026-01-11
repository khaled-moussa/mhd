<?php

namespace App\App\Web\Resources\Landing;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LandingSectionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'key'         => $this->key,
            'title'       => $this->title,
            'description' => $this->description,
            'visible'     => $this->visible,
            'order'       => $this->order,
            'data'        => $this->data,
        ];
    }
}