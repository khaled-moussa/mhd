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
    public array $removedImages = [];
    public array $existingImages = [];
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

            'visible' => [
                'nullable',
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
        $this->visible            = $companyProject->getVisibility()->value();
    }

    /*
    |-----------------------------
    | Resolve
    |-----------------------------
    */

    public static function resolveEmbedUrl(?string $input = null): ?string
    {
        if (!$input) {
            return null;
        }

        $input = trim($input);

        // iframe pasted → extract src
        if (preg_match('/src="([^"]+)"/i', $input, $match)) {
            $input = $match[1];
        }

        // Already embed URL
        if (str_contains($input, '/maps/embed')) {
            return $input;
        }

        // Short URL (maps.app.goo.gl)
        if (str_contains($input, 'maps.app.goo.gl')) {
            $expanded = self::expandShortUrl($input);
            return self::resolveEmbedUrl($expanded);
        }

        // Extract coordinates
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $input, $match)) {
            return "https://www.google.com/maps?q={$match[1]},{$match[2]}&output=embed";
        }

        // Fallback search
        return "https://www.google.com/maps?q=" . urlencode($input) . "&output=embed";
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
