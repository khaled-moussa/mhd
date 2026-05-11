<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class GetCompanyProjectsAction
{
    /*
    |-------------------------------
    | Execute
    |-------------------------------
    */
    public function execute(array $with = [], ?int $limit = null, ?bool $visible = null)
    {
        return $this->query($with, $limit, $visible)
            ->get();
    }

    /*
    |-------------------------------
    | Paginate
    |-------------------------------
    */
    public function paginate(int $perPage = 15, array $with = [], ?bool $visible = null)
    {
        return $this->query($with, $visible)
            ->paginate($perPage);
    }

    /*
    |-------------------------------
    | Take
    |-------------------------------
    */
    public function take(int $perPage = 15, array $with = [], ?bool $visible = null)
    {
        return $this->query($with, $visible)
            ->take($perPage)
            ->get();
    }

    /*
    |-------------------------------
    | Query Builder
    |-------------------------------
    */
    private function query(array $with = [], ?int $limit = null, ?bool $visible = null)
    {
        return CompanyProject::query()
            ->with($this->resolveRelations($with))
            ->when($limit, fn($q) => $q->limit($limit))
            ->when(!is_null($visible), fn($q) => $q->whereVisibility($visible))
            ->latest();
    }
    /*
    |-------------------------------
    | Resolve Relations
    |-------------------------------
    */
    private function resolveRelations(array $with = []): array
    {
        return array_unique([
            'media',
            ...$with,
        ]);
    }
}
