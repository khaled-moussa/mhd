<?php

namespace App\Domain\Users\Otp;

use App\Domain\Otp\Services\OtpFlowService;
use App\Domain\Users\Events\TwoFactorRequestedEvent;
use App\Domain\Users\Models\User;

class TwoFactorOtpFlow extends OtpFlowService
{
    protected function dispatch(User $user, array $context): void
    {
        TwoFactorRequestedEvent::dispatch($user);
    }

    public function key(User $user): string
    {
        return 'otp:two-factor:' . $user->getId();
    }
}
