<?php

namespace App\App\Web\Controllers\Auth;

use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function __invoke(string $email, string $token)
    {
        if (! $token) {
            return redirect()->route('auth.login');
        }

        return view('pages.auth.reset-password', [
            'type' => 'resetPassword',
            'email' => $email,
            'token' => $token,
        ]);
    }
}
