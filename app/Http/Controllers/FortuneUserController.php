<?php

namespace App\Http\Controllers;

use App\Models\Fortune;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\task;

class FortuneUserController extends Controller
{
    public function random()
    {
        $user = Auth::user();
        $fortune = Fortune::inRandomOrder()->first();

        $user->fortunes()->attach($fortune);

        return $fortune->toResource();
    }

    public function list(User $user)
    {
        Gate::authorize('access-fortunes', $user);

        return $user->fortunes->toResourceCollection();
    }

    public function get(User $user, Fortune $fortune)
    {
        Gate::authorize('access-fortunes', [$user, $fortune]);

        return $fortune->toResource();
    }

    public function detach(User $user, Fortune $fortune)
    {
        Gate::authorize('access-fortunes', [$user, $fortune]);

        $user->fortunes()->detach($fortune);

        return response(status: 204);
    }
}
