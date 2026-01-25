<?php

namespace App\Domain\CompanyProjects\Jobs;

use App\Domain\CompanyProjects\Models\CompanyProject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreCompanyProjectFilesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param array<int, string> $imagePaths
     */
    public function __construct(
        public CompanyProject $companyProject,
        public array $tempImagesPaths,
        public ?array $tempFileData = null, // single file data
    ) {}

    public function handle(): void
    {
        // Store images normally
        foreach ($this->tempImagesPaths as $imagePath) {
            $this->companyProject
                ->addMedia($imagePath)
                ->toMediaCollection('images');
        }

        // Store single file with original name
        if ($this->tempFileData) {
            // Clear existing file first
            $this->companyProject->clearMediaCollection('file');

            $this->companyProject
                ->addMedia($this->tempFileData['path'])
                ->usingName($this->tempFileData['name'])
                ->toMediaCollection('file');
        }
    }
}
