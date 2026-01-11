<?php

namespace App\Domain\Auth\Middlewares;

use App\Panel\Resolvers\PanelManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Redirect to login if is guest
        if (!Auth::check()) {
            return $next($request);
        }

        $panelManager = app(PanelManager::class);

        $panel = $panelManager->resolve($request->user());

        $panelManager->setCurrent($panel);

        return redirect()->route($panel->dashboardRoute());
    }
}
