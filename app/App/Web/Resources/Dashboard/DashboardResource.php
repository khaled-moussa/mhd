<?php

namespace App\App\Web\Resources\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'cards' => [
                [
                    'title' => 'Total Projects',
                    'value' => $this->projectsCount,
                    'icon'  => 'fi fi-tr-construction-location',
                    'color' => 'blue',
                ],
                [
                    'title' => 'Total Services',
                    'value' => $this->servicesCount,
                    'icon'  => 'fi-tc-person-carry-box',
                    'color' => 'green',
                ],
                [
                    'title' => 'Contacts',
                    'value' => $this->contactsCount,
                    'icon'  => 'fi fi-tr-customer-service',
                    'color' => 'orange',
                ],
            ],
        ];
    }
}