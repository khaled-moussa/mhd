<?php

namespace App\Domain\CompanyProjects\Jobs;

use App\Domain\CompanyProjects\Actions\SaveCompanyProjectImagesAction;
use App\Domain\CompanyProjects\Models\CompanyProject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class StoreCompanyProjectImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param array<int, string> $imagePaths
     */
    public function __construct(
        public CompanyProject $companyProject,
        public array $imagePaths,
    ) {}

    public function handle(): void
    {
        $disk = Storage::disk('public');

        $finalPaths = collect($this->imagePaths)
            ->map(function (string $path) use ($disk) {
                $newPath = str_replace('tmp/', '', $path);

                $disk->move($path, $newPath);

                return $newPath;
            })
            ->toArray();

        //  Remove tmp directory if empty
        $tmpDirectory = 'company-projects/tmp';

        if ($disk->exists($tmpDirectory) && empty($disk->files($tmpDirectory))) {
            $disk->deleteDirectory($tmpDirectory);
        }

        app(SaveCompanyProjectImagesAction::class)->execute(
            companyProject: $this->companyProject,
            imagePaths: $finalPaths
        );
    }
}
