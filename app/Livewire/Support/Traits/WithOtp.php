<?php

namespace App\Livewire\Support\Traits;

use App\Domain\Otp\Contracts\OtpFlowContract;
use App\Domain\Otp\Enums\OtpEventsEnum;
use App\Domain\Otp\Exceptions\ExpiredOtpException;
use App\Domain\Otp\Exceptions\InvalidOtpException;
use App\Domain\Otp\Exceptions\ToManyAttemptToVerifyOtpException;
use App\Domain\Otp\Exceptions\ToManyAttemptOtpRequestException;

trait WithOtp
{
    /**
     * Handle OTP-related exceptions for Livewire components.
     */
    final public function handleOtpKnownExceptions($e, $stopPropagation): void
    {
        if ($e instanceof ExpiredOtpException) {
            $this->handleOtpException($e, $stopPropagation);
        }
        if ($e instanceof InvalidOtpException) {
            $this->handleOtpException($e, $stopPropagation);
        }
        if ($e instanceof ToManyAttemptOtpRequestException) {
            $this->handleOtpException($e, $stopPropagation);
        }
        if ($e instanceof ToManyAttemptToVerifyOtpException) {
            $this->handleOtpException($e, $stopPropagation);
        }
    }

    /**
     * Send OTP using the given flow.
     *
     * @param OtpFlowContract $flow
     * @param array $context
     */
    protected function sendOtpFlow(OtpFlowContract $flow, array $context = []): void
    {
        $flow->send($this->user, $context);
        $this->dispatch(OtpEventsEnum::RESEND_EVENT);
    }

    /**
     * Verify OTP using the given flow.
     *
     * @param OtpFlowContract $flow
     * @param string $otp
     * @return bool
     */
    protected function verifyOtp(OtpFlowContract $flow, string $otp): bool
    {
        return $flow->verify($this->user, $otp);
    }

    /**
     * Dispatch OTP error event.
     *
     * @param string $exception
     * @param string $message
     */
    protected function dispatchOtpErrorEvent(string $exception, string $message): void
    {
        $this->dispatch(
            OtpEventsEnum::OTP_ERROR_EVENT,
            exception: $exception,
            message: $message
        );
    }
}
