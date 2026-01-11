<?php

namespace App\App\Web\Requests\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

class CustomEmailVerificationRequest extends EmailVerificationRequest
{
    public function authorize()
    {
        $user = $this->user();

        if (! $user) {
            return false;
        }

        if (! hash_equals(
            (string) $user->getUuid(),
            (string) $this->route('id')
        )) {
            return false;
        }

        if (! hash_equals(
            sha1($user->getEmailForVerification()),
            (string) $this->route('hash')
        )) {
            return false;
        }

        return true;
    }
}
