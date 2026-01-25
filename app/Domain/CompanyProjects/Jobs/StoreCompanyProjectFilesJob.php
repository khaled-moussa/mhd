<?php

namespace App\Domain\CompanyProjects\Jobs;

use App\Domain\CompanyProjects\Actions\AttemptToStoreBrochureAction;
use App\Domain\CompanyProjects\Actions\AttemptToStoreImagesAction;
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
            app(AttemptToStoreImagesAction::class)->execute(
                project: $this->companyProject,
                tempImagesPaths: $this->tempImagesPaths
            );
        }

        // Store brochure (single file)
        if (!is_null($this->tempFileData)) {
            app(AttemptToStoreBrochureAction::class)->execute(
                project: $this->companyProject,
                tempFileData: $this->tempFileData
            );
        }
    }
}
