<?php

namespace App\Domain\CompanyProjects\States\VisibilityStates;

class NotVisibleState extends VisibilityStates
{
    public function label(): string
    {
        return 'Not Visible';
    }

    public function value(): bool
    {
        return false;
    }

    public function badge(): string
    {
        return 'danger';
    }

    public function color(): string
    {
        return "red-500";
    }

    public function icon(): string
    {
        return 'fi-rr-circle-xmark';
    }
}
