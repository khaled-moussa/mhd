<?php

namespace App\Domain\Settings\States\TwoFactorStates;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class TwoFactorStates extends State
{
    abstract public function value(): bool;
    abstract public function label(): string;
    abstract public function buttonLabel(): string;
    abstract public function colorClass(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(TwoFactorDisableState::class)
            ->allowAllTransitions();
    }
}
