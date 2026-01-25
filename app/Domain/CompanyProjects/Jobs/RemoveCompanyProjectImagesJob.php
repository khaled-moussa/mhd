<?php

namespace App\Domain\CompanyProjects\Jobs;

use App\Domain\CompanyProjects\Models\CompanyProject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RemoveCompanyProjectImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param array<int, string> $imagePaths
     */
    public function __construct(
        public CompanyProject $companyProject,
        public array $removedImageIds,
    ) {}

    public function handle(): void
    {
        $this->companyProject
            ->media()
            ->whereIn('id', $this->removedImageIds)
            ->delete();
    }
}
