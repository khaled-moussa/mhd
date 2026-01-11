<?php

namespace App\Domain\Landing\Policies;

use App\Domain\Landing\Models\LandingSection;
use App\Domain\Users\Models\User;
use App\Support\Policies\BasePolicy;

class LandingPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function access(User $user): bool
    {
        return $this->canAccess(user: $user, resource: 'site-editor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LandingSection $model): bool
    {
        return $this->canView(user: $user, resource: 'site-editor');
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->canCreate(user: $user, resource: 'site-editor');
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LandingSection $model): bool
    {
        return $this->canUpdate(user: $user, resource: 'site-editor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LandingSection $model): bool
    {
        return $this->canDelete(user: $user, resource: 'site-editor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LandingSection $model): bool
    {
        return $this->canForceDelete(user: $user, resource: 'site-editor');
    }
}
