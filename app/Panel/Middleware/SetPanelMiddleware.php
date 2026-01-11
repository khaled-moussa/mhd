<?php

namespace App\Panel\Middleware;

use Closure;
use App\Panel\Enums\PanelEnum;
use App\Panel\Resolvers\PanelManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetPanelMiddleware
{
    public function handle(Request $request, Closure $next, string $panel): Response
    {
        if (! Auth::check()) {
            return redirect()->route('auth.login');
        }

        $panelEnum = PanelEnum::from($panel);

        $panelManager = app(PanelManager::class);

        // panel resolved from user
        $resolvedPanel = $panelManager->resolve($request->user());

        // User trying to access another panel
        if ($resolvedPanel->id() !== $panelEnum->value) {
            abort(403, 'Unauthorized panel access.');
        }

        // Set current panel
        $panelManager->setCurrent($resolvedPanel);

        return $next($request);
    }
}
