<?php

namespace App\Support\Traits;

trait HandlePaginationButtons
{
    public $currentPage;
    public $firstPage;
    public $lastPage;
    public $startingPage;
    public $endingPage;

    public function initPaginationButtons($paginator)
    {
        $this->firstPage = 1;
        $this->lastPage  = $paginator->lastPage();

        $this->currentPage = $paginator->currentPage();

        $this->startingPage = max(2, $this->currentPage - 1);
        $this->endingPage   = min($this->lastPage - 1, $this->currentPage + 1);
    }
}
