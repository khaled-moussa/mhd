<?php

namespace App\Domain\Emails\Actions;

use App\Domain\Auth\Emails\VerifyAccountDeletionRequestMail;
use App\Domain\Users\Models\User;
use Illuminate\Support\Facades\Mail;

class SendAccountDeletionEmailAction
{
    public function execute(User $user): void
    {
        Mail::to($user->getEmail())
            ->send(new VerifyAccountDeletionRequestMail(
                name: $user->getFullName(),
                oneTimePassword: $user->createOneTimePassword()
            ));
    }
}
