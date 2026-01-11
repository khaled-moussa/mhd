<?php

namespace App\App\Web\Controllers\Auth;

use App\Domain\Auth\Actions\AttemptToLoginWithProviderAction;
use App\Domain\Users\Actions\RedirectToDashboardRouteAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the provider's authentication page.
     */
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from the provider.
     */
    public function callback(string $provider)
    {
        // Get user info from provider
        $userProvider = Socialite::driver($provider)->user();

        // Attempt login or register if necessary
        $user = app(AttemptToLoginWithProviderAction::class)
            ->execute(
                userProvider: $userProvider,
                provider: $provider
            );

        // Authenticate the user
        Auth::login($user);

        // Determine the redirect route
        $redirectRoute = app(RedirectToDashboardRouteAction::class)
            ->execute(user: $user);

        if (session('redirect_to_settings')) {
            session()->forget('redirect_to_settings');
            return redirect()->route($user->getPanelId() . '.settings.security');
        }

        // Redirect to dashboard
        return redirect()->route($redirectRoute);
    }
}
