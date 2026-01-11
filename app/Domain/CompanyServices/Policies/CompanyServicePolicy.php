<?php

namespace App\Domain\CompanyServices\Policies;

use App\Domain\ServiceRequests\Models\ServiceRequest;
use App\Domain\Users\Models\User;
use App\Support\Policies\BasePolicy;

class CompanyServicePolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function access(User $user): bool
    {
        return $this->canAccess(user: $user, resource: 'company_services');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ServiceRequest $model): bool
    {
        return $this->canView(user: $user, resource: 'company_services');
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->canCreate(user: $user, resource: 'company_services');
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ServiceRequest $model): bool
    {
        return $this->canUpdate(user: $user, resource: 'company_services');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ServiceRequest $model): bool
    {
        return $this->canDelete(user: $user, resource: 'company_services');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceRequest $model): bool
    {
        return $this->canForceDelete(user: $user, resource: 'company_services');
    }
}
