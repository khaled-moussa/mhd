<?php

namespace App\Domain\Auth\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailVerifiedMiddleware
{
    /* -------------------------------
    | Handle Middleware
    ------------------------------- */
    public function handle(Request $request, Closure $next): Response
    {
        // Redirect auth to verify email
        if (! $request->user()?->hasVerifiedEmail()) {
            return redirect()->route('auth.verification.notice');
        }

        return $next($request);
    }
}
