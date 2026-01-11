<?php

namespace App\App\Web\Controllers\Auth;

use App\App\Web\Requests\Auth\CustomEmailVerificationRequest;
use App\Domain\Auth\Notifications\VerifyEmailRequestNotification;
use App\Http\Controllers\Controller;
use App\Panel\Resolvers\PanelManager;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    /**
     * Show the email verification page.
     */
    public function index()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return $this->redirectToDashboard();
        }

        return view('pages.auth.verification');
    }

    /**
     * Handle the email verification callback.
     */
    public function verify(CustomEmailVerificationRequest $request)
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return $this->redirectToDashboard();
        }

        $request->fulfill();

        session()->flash('user_info', [
            'type'    => 'info',
            'title'   => 'Email Verified!',
            'message' => 'Your email has been successfully verified.',
        ]);

        return redirect()->route('auth.login');
    }

    /**
     * Resend the verification email.
     */
    public function resend()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return $this->redirectToDashboard();
        }

        Auth::user()->notify(new VerifyEmailRequestNotification());

        session()->flash('verify_email_status', [
            'type'    => 'success',
            'message' => 'A new verification link has been sent to your email.',
        ]);

        return back();
    }

    /**
     * Redirect user to their panel dashboard.
     */
    private function redirectToDashboard()
    {
        $panelManager = app(PanelManager::class);

        $panel = $panelManager->resolve(Auth::user());

        $panelManager->setCurrent($panel);

        return redirect()->route($panel->dashboardRoute());
    }
}
