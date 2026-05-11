<?php

namespace App\Domain\Auth\Actions;

use Illuminate\Foundation\Auth\User;

class PanelResolverAction
{
    public static function panelRoute(User $user): string
    {
        return match (true) {
            $user->isAdminPanel()  => route('admin.dashboard'),
            $user->isUserPanel()   => route('user.dashboard'),
            default                => static::loginRoute(),
        };
    }

    public static function loginRoute(): string
    {
        return route('auth.login');
    }
}
