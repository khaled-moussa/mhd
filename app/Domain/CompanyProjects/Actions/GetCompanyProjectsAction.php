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
    public function execute(array $with = [], ?bool $visible = null)
    {
        return $this->query($with, $visible)
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
    | Query Builder
    |-------------------------------
    */
    private function query(array $with = [],  ?bool $visible = null)
    {
        return CompanyProject::query()
            ->with($with)
            ->when(!is_null($visible), fn($q) => $q->whereVisibility($visible))
            ->latest();
    }
}
