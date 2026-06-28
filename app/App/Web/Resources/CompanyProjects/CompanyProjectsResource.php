<?php

namespace App\App\Web\Resources\CompanyProjects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProjectsResource extends JsonResource
{
    /*
    |-------------------------------
    | Transform Resource
    |-------------------------------
    */
    public function toArray(Request $request): array
    {
        return [
            'uuid'               => $this->getUuid(),
            'title'              => $this->getTitle(),
            'description'        => $this->getDescription(),

            'image_cover'        => $this->getImageCover(),
            'images'             => $this->getImages(),

            'brochure'           => $this?->getBrochure(),

            'price_start'        => $this->getPriceStart(),
            'address'            => $this->getAddress(),
            'location'           => $this->getLocation(),

            'visible_value'      => $this->getVisibility()->value(),
            'visible_label'      => $this->getVisibility()->label(),
            'visible_badge'      => $this->getVisibility()->badge(),
            'visible_text_color' => $this->getVisibility()->textColor(),
            'visible_icon'       => $this->getVisibility()->icon(),

            'delivered_at'       => $this->getDeliveredAt(),
            'created_at'         => $this->getCreatedAt(),
            'updated_at'         => $this->getUpdatedAt(),
        ];
    }
}