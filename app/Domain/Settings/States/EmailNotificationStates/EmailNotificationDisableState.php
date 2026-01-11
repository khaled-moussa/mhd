<?php

namespace App\Domain\Settings\States\EmailNotificationStates;

class EmailNotificationDisableState extends EmailNotificationStates
{
    public function label(): string
    {
        return 'Disable';
    }

    public function value(): bool
    {
        return false;
    }

    public function colorClass(): string
    {
        return "warning";
    }
}
