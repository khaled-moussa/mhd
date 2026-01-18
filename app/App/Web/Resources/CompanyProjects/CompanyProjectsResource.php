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
            'uuid'           => $this->getUuid(),
            'images'         => $this->getImages(),
            'title'          => $this->getTitle(),
            'description'    => $this->getDescription(),
            'price_start'    => $this->getPriceStart(),
            'address'        => $this->getAddress(),
            'location'       => $this->getLocation(),
            'visible_value'  => $this->getVisibility()->value(),
            'visible_label'  => $this->getVisibility()->label(),
            'visible_badge'  => $this->getVisibility()->badge(),
            'visible_color'  => $this->getVisibility()->color(),
            'visible_icon'   => $this->getVisibility()->icon(),
            'delivered_at'   => $this->getDeliveredAt(),
            'created_at'     => $this->getCreatedAt(),
            'updated_at'     => $this->getUpdatedAt(),
        ];
    }
}
