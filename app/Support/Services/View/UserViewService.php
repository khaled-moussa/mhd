<?php

namespace App\Support\Services\View;

use Illuminate\Support\Facades\View;
use App\App\Web\Resources\Users\UsersResource;
use App\Domain\Users\Actions\GetCurrentUserAction;

class UserViewService
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $currentUser = app(GetCurrentUserAction::class)->execute();

            if (! $currentUser) {
                return;
            }

            $view->with('authUser', [
                'uuid' => $currentUser->getUuid(),
                'full_name' => $currentUser->getFullName(),
                'email' => $currentUser->getEmail(),
            ]);
        });
    }
}
