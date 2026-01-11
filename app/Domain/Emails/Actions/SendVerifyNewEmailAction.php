<?php

namespace App\Domain\Emails\Actions;

use App\Domain\Auth\Emails\VerifyEmailCodeRequestMail;
use App\Domain\Users\Models\User;
use Illuminate\Support\Facades\Mail;

class SendVerifyNewEmailAction
{
    public function execute(User $user, string $newEmail): void
    {
        Mail::to($newEmail)
            ->send(new VerifyEmailCodeRequestMail(
                name: $user->getFullName(),
                oneTimePassword: $user->createOneTimePassword()
            ));
    }
}
