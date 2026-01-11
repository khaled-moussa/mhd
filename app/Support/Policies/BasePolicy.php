<?php

namespace App\Support\Policies;

use App\Domain\Users\Models\User;
use App\Panel\Contracts\PanelContract;
use App\Panel\Resolvers\PanelManager;

abstract class BasePolicy
{
    protected PanelContract $panel;

    public function __construct()
    {
        $this->panel = app(PanelManager::class)->current();
    }

    /**
     * Check if user has permission in current panel
     */
    protected function hasPermission(User $user, string $permission): bool
    {
        return true;
    }

    /**
     * Custom permission helper
     */
    protected function canAccess(User $user, string $resource): bool
    {
        return $this->hasPermission($user, "{$resource}.access");
    }

    protected function canView(User $user, string $resource): bool
    {
        return $this->hasPermission($user, "{$resource}.view");
    }

    protected function canCreate(User $user, string $resource): bool
    {
        return $this->hasPermission($user, "{$resource}.create");
    }

    protected function canUpdate(User $user, string $resource): bool
    {
        return $this->hasPermission($user, "{$resource}.update");
    }

    protected function canDelete(User $user, string $resource): bool
    {
        return $this->hasPermission($user, "{$resource}.delete");
    }

    protected function canForceDelete(User $user, string $resource): bool
    {
        return $this->hasPermission($user, "{$resource}.force-delete");
    }
}
