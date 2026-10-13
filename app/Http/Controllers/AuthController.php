<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated())->refresh();

        return $user->toResource()
            ->additional([
                '_token' => $user->createToken('api')->plainTextToken,
            ])
            ->response()
            ->setStatusCode(201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::withTrashed()->whereUsername($request->validated()['username'])->first();

        if ($user->deleted_at !== null) {
            $user->restore();
        }


       if (Auth::once($request->validated())) {
           $user = Auth::user();

           return $user->toResource()
               ->additional(['_token' => $user->createToken('api')->plainTextToken])
               ->response()
               ->setStatusCode(200);
       }

       return response()->json([
           'message' => 'Bad credentials provided',
       ],
       status: 401);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}
