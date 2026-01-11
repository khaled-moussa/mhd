<?php

namespace App\Domain\Auth\Middlewares;

use App\Panel\Resolvers\PanelManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanelPermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(401);
        }

        $panel = app(PanelManager::class)->resolve($user);

        if (! $user->hasCustomPermissionTo($permission, $panel)) {
            abort(403);
        }

        return $next($request);
    }
}
