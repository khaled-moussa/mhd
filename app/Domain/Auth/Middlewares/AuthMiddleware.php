<?php

namespace App\Domain\Auth\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        info(1);
        // Redirect guests to login
        if (! Auth::check()) {
            return redirect()->route('auth.login');
        }

        return $next($request);
    }
}
