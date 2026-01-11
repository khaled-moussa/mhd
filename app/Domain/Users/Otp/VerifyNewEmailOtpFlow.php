<?php

namespace App\Domain\Users\Otp;

use App\Domain\Users\Exceptions\InvalidNewEmailArgumentException;
use App\Domain\Otp\Services\OtpFlowService;
use App\Domain\Users\Events\VerifyNewEmailRequestedEvent;
use App\Domain\Users\Models\User;

class VerifyNewEmailOtpFlow extends OtpFlowService
{
    protected function dispatch(User $user, array $context): void
    {
        $newEmail = $context['newEmail'] ?? null;

        if (!$newEmail) {
            throw new InvalidNewEmailArgumentException();
        }

        VerifyNewEmailRequestedEvent::dispatch($user, $newEmail);
    }

    public function key(User $user): string
    {
        return 'otp:new-email:' . $user->getId();
    }
}
