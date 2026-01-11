<?php

namespace App\Domain\Settings\Policies;

use App\Domain\Users\Models\User;
use App\Support\Policies\BasePolicy;

class SettingPolicy extends BasePolicy
{
    /**
     * View profile information
     */
    public function viewProfile(User $user): bool
    {
        return $this->canView(user: $user, resource: 'view_profile');
    }

    /**
     * View security settings
     */
    public function viewSecurity(User $user): bool
    {
        return $this->canView(user: $user, resource: 'view_security');
    }

    /**
     * View notifications
     */
    public function viewNotification(User $user): bool
    {
        return $this->canView(user: $user, resource: 'view_notification');
    }

    /**
     * Update email
     */
    public function updateEmail(User $user): bool
    {
        return $this->canUpdate(user: $user, resource: 'update_email');
    }

    /**
     * Delete account
     */
    public function deleteAccount(User $user): bool
    {
        return $this->canDelete(user: $user, resource: 'delete_account');
    }

    /**
     * Change password
     */
    public function changePassword(User $user): bool
    {
        return $this->canUpdate(user: $user, resource: 'change_password');
    }
}
