<?php

namespace App\Domain\Settings\States\EmailNotificationStates;

class EmailNotificationEnableState extends EmailNotificationStates
{
    public function label(): string
    {
        return 'Enable';
    }

    public function value(): bool
    {
        return true;
    }

    public function colorClass(): string
    {
        return 'success';
    }
}
