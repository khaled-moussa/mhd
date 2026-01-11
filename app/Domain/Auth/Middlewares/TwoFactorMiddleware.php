<?php

namespace App\Domain\Auth\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\Auth\Actions\GetTwoFactorSessionStateAction;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request?->user();

        if (! $user) {
            return redirect()->route('auth.login');
        }

        if (app(GetTwoFactorSessionStateAction::class)->execute()) {
            return redirect()->route('auth.two-factor');
        }

        return $next($request);
    }
}
