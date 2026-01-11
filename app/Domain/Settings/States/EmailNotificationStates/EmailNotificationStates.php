<?php

namespace App\Domain\Settings\States\EmailNotificationStates;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class EmailNotificationStates extends State
{
    abstract public function label(): string;
    abstract public function value(): bool;
    abstract public function colorClass(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(EmailNotificationDisableState::class)
            ->allowAllTransitions();
    }
}
