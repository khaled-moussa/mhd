<?php

namespace App\Navigation\Sidebar;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SidebarItem
{
    public function __construct(
        public string $label,
        public string $routeName,
        public string $icon,
        public array $activePatterns = [],

        // Policy config
        public ?string $policyAbility = null,
        public ?string $policyModel = null,
    ) {}

    public function url(): string
    {
        return route($this->routeName);
    }

    public function isActive(): bool
    {
        if (request()->routeIs($this->routeName . '*')) {
            return true;
        }

        foreach ($this->activePatterns as $pattern) {
            if (request()->routeIs($pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Policy-based visibility
     */
    public function isVisible(): bool
    {
        if (! Auth::check()) {
            return false;
        }

        // No policy → always visible
        if (! $this->policyAbility || ! $this->policyModel) {
            return true;
        }

        return Gate::allows(
            $this->policyAbility,
            $this->policyModel
        );
    }
}
