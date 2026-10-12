<?php

namespace App\Providers;

use App\Models\Fortune;
use App\Models\User;
use Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-fortunes', function (User $user, User $requested, ?Fortune $fortune = null) {
            if (!($user->is($requested))) {
                return Response::denyAsNotFound();
            }

            if (!is_null($fortune) && !$user->fortunes()->where('id', $fortune->id)->exists()) {
                return Response::denyAsNotFound();
            }

            return Response::allow();
        });
    }
}
