<?php

namespace App\Domain\Settings\States\DesktopNotificationStates;

class DesktopNotificationDisableState extends DesktopNotificationStates
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
