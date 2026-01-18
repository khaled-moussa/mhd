<?php

namespace App\Domain\CompanyProjects\States\VisibilityStates;

class VisibleState extends VisibilityStates
{
    public function label(): string
    {
        return 'Visible';
    }

    public function value(): bool
    {
        return true;
    }

    public function badge(): string
    {
        return "success";
    }

    public function color(): string
    {
        return "green-500";
    }

    public function icon(): string
    {
        return 'fi-rr-check-circle';
    }
}
