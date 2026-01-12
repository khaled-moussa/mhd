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
    public ?string $delivered_at = null;
    public float $price_start = 0;
    public string $address = '';
    public ?string $location = null;
    public ?array $images = null;
    public string $visibility_state = '';

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

            'delivered_at' => [
                'nullable',
                'date',
            ],

            'price_start' => [
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

            'images' => [
                'nullable',
                'array',
            ],

            'visibility_state' => [
                'required',
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
        $this->delivered_at       = optional($companyProject->getDeliveredAt())->toDateString();
        $this->price_start        = $companyProject->getPriceStart();
        $this->address            = $companyProject->getAddress();
        $this->location           = $companyProject->getLocation();
        $this->images             = $companyProject->getImages();
        $this->visibility_state   = $companyProject->getVisibilityState();
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
