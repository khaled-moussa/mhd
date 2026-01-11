<?php

namespace App\Domain\Emails\Actions;

use App\Domain\Auth\Emails\VerifyTwoFactorCodeRequestMail;
use App\Domain\Users\Models\User;
use Illuminate\Support\Facades\Mail;

class SendTwoFactorEmailAction
{
    public function execute(User $user): void
    {
        Mail::to($user->getEmail())
            ->send(new VerifyTwoFactorCodeRequestMail(
                name: $user->getFullName(),
                oneTimePassword: $user->createOneTimePassword()
            ));
    }
}
