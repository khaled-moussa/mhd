<?php

namespace App\Domain\CompanyProjects\States\VisibilityStates;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class VisibilityStates extends State
{
    abstract public function label(): string;
    abstract public function value(): bool;
    abstract public function badge(): string;
    abstract public function color(): string;
    abstract public function icon(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(VisibleState::class)
            ->allowAllTransitions();
    }
}
