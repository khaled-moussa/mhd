<?php

namespace App\Domain\CompanyProjects\Jobs;

use App\Domain\CompanyProjects\Actions\StoreCompanyProjectBrochureAction;
use App\Domain\CompanyProjects\Actions\StoreCompanyProjectImagesAction;
use App\Domain\CompanyProjects\Models\CompanyProject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreCompanyProjectFilesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public CompanyProject $companyProject,
        public array $tempImagesPaths = [],
        public ?array $tempFileData = null, // single file (brochure)
    ) {}

    public function handle(): void
    {
        // Store images
        if (!empty($this->tempImagesPaths)) {
            app(StoreCompanyProjectImagesAction::class)->execute(
                $this->companyProject,
                $this->tempImagesPaths
            );
        }

        // Store brochure (single file)
        if (!is_null($this->tempFileData)) {
            app(StoreCompanyProjectBrochureAction::class)->execute(
                $this->companyProject,
                $this->tempFileData
            );
        }
    }
}
