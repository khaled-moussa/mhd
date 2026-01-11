<?php

namespace App\Domain\Landing\VisibilityStates;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class VisibilityStates extends State
{
    abstract public function label(): string;

    abstract public function value(): bool;

    abstract public function colorClass(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(VisibleState::class)
            ->allowAllTransitions();
    }
}
