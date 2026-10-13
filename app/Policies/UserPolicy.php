<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function deactivate(User $user): Response
    {
        return $user->is(Auth::user()) ? Response::allow() : Response::denyAsNotFound();
    }
}
