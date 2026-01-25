<?php

namespace App\Support\Services\View;

use Illuminate\Support\Facades\View;
use App\App\Web\Resources\Users\UserViewResource;
use App\Domain\Users\Actions\GetCurrentUserAction;

class UserViewService
{
    public function boot(): void
    {
        View::composer([
            'components.dropdown.profile',
            'layouts.partials.scripts'
        ], function ($view) {
            $currentUser = app(GetCurrentUserAction::class)
                ->execute();

            if (! $currentUser) {
                return;
            }

            $userData = (new UserViewResource($currentUser))
                ->resolve();

            $view->with('currentUser', $userData);
        });
    }
}
