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

    public string $title = '';
    public string $description = '';

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
