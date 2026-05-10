<?php

namespace App\Livewire\Panels\Admin\CompanyProjects\Forms;

use App\Domain\CompanyProjects\Models\CompanyProject;
use Livewire\Attributes\Locked;
use Livewire\Form;

class CompanyProjectFormComponent extends Form
{
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
    public $priceStart = 0;
    public string $address = '';
    public ?string $location = null;
    public array $images = [];
    public array $removedImages = [];
    public array $existingImages = [];
    public $file;
    public array $existingFile = [];
    public bool $visible = true;

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
                'min:1',
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

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx',
                'max:5120', // 5 MB
            ],

            'visible' => [
                'boolean'
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
        $this->deliveredAt        = $companyProject->getDeliveredAt();
        $this->priceStart         = $companyProject->getPriceStart();
        $this->address            = $companyProject->getAddress();
        $this->location           = $companyProject->getLocation();
        $this->existingImages     = $companyProject->getImages();
        $this->removedImages      = [];
        $this->existingFile       = $companyProject->getBrochure();
        $this->visible            = $companyProject->getVisibility()->value();
    }

    /*
    |-----------------------------
    | Resolve
    |-----------------------------
    */

    public static function resolveEmbedUrl(?string $input = null): ?string
    {
        if (blank($input)) {
            return null;
        }

        $input = trim($input);

        // Extract iframe src
        if (preg_match('/src="([^"]+)"/i', $input, $match)) {
            return $match[1];
        }

        // Already resolved embed URL
        if (
            str_contains($input, '/maps/embed') ||
            str_contains($input, 'output=embed')
        ) {
            return $input;
        }

        // Google short URL
        if (str_contains($input, 'maps.app.goo.gl')) {
            $expanded = self::expandShortUrl($input);

            return self::resolveEmbedUrl($expanded);
        }

        // Coordinates
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $input, $match)) {
            return sprintf(
                'https://www.google.com/maps?q=%s,%s&output=embed',
                $match[1],
                $match[2]
            );
        }

        // Plain Google Maps URL
        if (filter_var($input, FILTER_VALIDATE_URL)) {
            return $input;
        }

        // Plain text address 
        return 'https://www.google.com/maps?q=' . urlencode($input) . '&output=embed';
    }

    private static function expandShortUrl(string $url): string
    {
        $headers = get_headers($url, true);

        if (isset($headers['Location'])) {
            return is_array($headers['Location'])
                ? end($headers['Location'])
                : $headers['Location'];
        }

        return $url;
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
