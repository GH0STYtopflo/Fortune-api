<?php

namespace App\Http\Controllers;

use App\Jobs\ExportUserInfo;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    public function deactivate(User $user) {
        Gate::authorize('user-resource', $user);

        $user->delete();

        return response(status: 204);
    }

    public function export(User $user)
    {
        Gate::authorize('user-resource', $user);

        ExportUserInfo::dispatch($user);
    }
}
