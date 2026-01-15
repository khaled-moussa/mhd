<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use Livewire\Attributes\Locked;
use Livewire\Form;

class CompanyProjectFormComponent extends Form
{
    use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    #[Locked]
    public string $companyProjectUuid = '';

    public string $title = '';
    public string $description = '';
    public ?string $deliveredAt = null;
    public float $priceStart = 0;
    public string $address = '';
    public ?string $location = null;
    public array $images = [];
    public string $visibilityState = '';

    /*
    |-----------------------------
    | Validation Rules
    |-----------------------------
    */
    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
                'min:3',
            ],

            'deliveredAt' => [
                'nullable',
                'date',
            ],

            'priceStart' => [
                'required',
                'numeric',
                'min:0',
            ],

            'address' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'location' => [
                'nullable',
                'string',
            ],

            'images.*' => [
                'image',
                'max:5120'
            ], // 5MB

            'visibilityState' => [
                'nullable',
                'string',
                'in:draft,visible,hidden',
            ],
        ];
    }

    /*
    |-----------------------------
    | Fill project data
    |-----------------------------
    */
    public function fillCompanyProject(CompanyProject $companyProject): void
    {
        // Reset form to clear validation errors
        $this->resetForm();

        $this->companyProjectUuid = $companyProject->getUuid();
        $this->title              = $companyProject->getTitle();
        $this->description        = $companyProject->getDescription();
        $this->deliveredAt        = optional($companyProject->getDeliveredAt())->toDateString();
        $this->priceStart         = $companyProject->getPriceStart();
        $this->address            = $companyProject->getAddress();
        $this->location           = $companyProject->getLocation();
        $this->images             = $companyProject->getImages();
        $this->visibilityState    = $companyProject->getVisibilityState();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    public function resetForm(): void
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
}
