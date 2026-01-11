<?php

namespace App\Panel\Resolvers;

use App\Domain\Users\Models\User;
use App\Panel\Contracts\PanelContract;
use App\Panel\Enums\PanelEnum;
use App\Panel\Panels\AdminPanel;
use App\Panel\Panels\UserPanel;
use LogicException;

class PanelManager
{
    protected ?PanelContract $current = null;

    /* 
    |-------------------------------
    | Resolve Panel
    |------------------------------- 
    */
    public function resolve(User|PanelEnum|PanelContract|string $source): PanelContract
    {
        return match (true) {
            is_string($source) => $this->fromString($source),
            $source instanceof PanelContract => $source,
            $source instanceof PanelEnum => $this->fromEnum($source),
            $source instanceof User => $this->fromEnum($source->panel()),
            default => throw new LogicException('Invalid panel source'),
        };
    }

    /* 
    |-------------------------------
    | Current Panel Management
    |------------------------------- 
    */
    public function setCurrent(PanelContract $panel): void
    {
        $this->current = $panel;
    }

    public function current(): PanelContract
    {
        if ($this->current === null) {
            throw new LogicException('Panel not resolved yet.');
        }

        return $this->current;
    }

    public function is(PanelEnum|string $panel): bool
    {
        return match (true) {
            is_string($panel) => $this->current()->id() === $panel,
            $panel instanceof PanelEnum => $this->current()->id() === $panel->value,
            default => false,
        };
    }

    /* 
    |-------------------------------
    | Panel Factory
    |------------------------------- 
    */
    private function fromString(string $panel): PanelContract
    {
        return match ($panel) {
            PanelEnum::ADMIN->value => app(AdminPanel::class),
            PanelEnum::USER->value  => app(UserPanel::class),
            default => throw new LogicException('Unknown panel string provided.'),
        };
    }

    private function fromEnum(PanelEnum $panel): PanelContract
    {
        return match ($panel) {
            PanelEnum::ADMIN => app(AdminPanel::class),
            PanelEnum::USER  => app(UserPanel::class),
        };
    }
}
