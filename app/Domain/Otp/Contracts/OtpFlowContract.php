<?php

namespace App\Domain\Otp\Contracts;

use App\Domain\Users\Models\User;
use Spatie\OneTimePasswords\Enums\ConsumeOneTimePasswordResult;

interface OtpFlowContract
{
    public function send(User $user, array $context = []): void;

    public function verify(User $user, string $otp): bool;

    public function key(User $user): string;
}
