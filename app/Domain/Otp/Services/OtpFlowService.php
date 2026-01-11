<?php

namespace App\Domain\Otp\Services;

use App\Domain\Otp\Contracts\OtpFlowContract;
use App\Domain\Otp\Exceptions\ExpiredOtpException;
use App\Domain\Otp\Exceptions\InvalidOtpException;
use App\Domain\Otp\Exceptions\ToManyAttemptToVerifyOtpException;
use App\Domain\Otp\Exceptions\ToManyAttemptOtpRequestException;
use App\Domain\Users\Models\User;
use Illuminate\Support\Facades\RateLimiter;

abstract class OtpFlowService implements OtpFlowContract
{
    protected int $maxAttempts = 3;
    protected int $decaySeconds = 120;

    final public function send(User $user, array $context = []): void
    {
        $key = $this->key($user);

        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            throw new ToManyAttemptOtpRequestException();
        }

        RateLimiter::hit($key, $this->decaySeconds);

        $this->dispatch($user, $context);
    }

    final public function verify(User $user, string $otp): bool
    {
        $result = $user->consumeOneTimePassword($otp);

        if (method_exists($result, 'isOk') && !$result->isOk()) {
            info($result->value);
            if (property_exists($result, 'value') && $result->value === 'rateLimitExceeded') {
                throw new ToManyAttemptToVerifyOtpException();
            }

            if (property_exists($result, 'value') && $result->value === 'oneTimePasswordExpired') {
                throw new ExpiredOtpException();
            }

            if (property_exists($result, 'value') && ($result->value === 'incorrectOneTimePassword' || $result->value === 'noOneTimePasswordsFound')) {
                throw new InvalidOtpException();
            }

            return false;
        }

        return true;
    }

    abstract protected function dispatch(User $user, array $context): void;
}
