<?php

namespace App\App\Web\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        if (! $token) {
            return redirect()->route('auth.login');
        }

        return view('pages.auth.reset-password', [
            'type'  => 'resetPassword',
            'email' => $email,
            'token' => $token,
        ]);
    }
}