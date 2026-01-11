<?php

namespace App\Domain\Settings\States\DesktopNotificationStates;

class DesktopNotificationEnableState extends DesktopNotificationStates
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
