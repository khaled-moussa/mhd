<?php

namespace App\Domain\Users\Otp;

use App\Domain\Otp\Services\OtpFlowService;
use App\Domain\Users\Events\AccountDeletionRequestedEvent;
use App\Domain\Users\Models\User;

class AccountDeletionOtpFlow extends OtpFlowService
{
    protected function dispatch(User $user, array $context): void
    {
        AccountDeletionRequestedEvent::dispatch($user);
    }

    public function key(User $user): string
    {
        return 'otp:account-deletion:' . $user->getId();
    }
}
