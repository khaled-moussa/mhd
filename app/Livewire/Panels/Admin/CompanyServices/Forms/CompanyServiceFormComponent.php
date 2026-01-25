<?php

namespace App\Livewire\Panels\Admin\CompanyServices\Forms;

use App\Domain\CompanyServices\Models\CompanyService;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use Livewire\Attributes\Locked;
use Livewire\Form;

class CompanyServiceFormComponent extends Form
{
    use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    #[Locked]
    public string $companyServiceUuid = '';

    public string $icon = '';
    public string $title = '';
    public string $description = '';
    public bool $visible = true;

    /*
    |-----------------------------
    | Validation Rules
    |-----------------------------
    */
    protected function rules(): array
    {
        return [
            'icon' => [
                'required',
                'string',
            ],

            'title' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'description'  => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
        ];
    }

    /*
    |-----------------------------
    | Fill service data
    |-----------------------------
    */
    public function fillCompanyService(CompanyService $companyService): void
    {
        // Reseting form to clear validtions errors
        $this->resetForm();

        $this->companyServiceUuid  = $companyService->getUuid();
        $this->title = $companyService->getTitle();
        $this->description  = $companyService->getDescription();
        $this->visible = $companyService->getVisibility()->value();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    public function resetForm()
    {
        $this->reset([
            'companyServiceUuid',
            'title',
            'description',
        ]);

        $this->resetValidation();
        $this->resetErrorBag();
    }
}
