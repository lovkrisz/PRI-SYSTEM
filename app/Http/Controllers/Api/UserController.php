<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginRequest $req)
    {
        if (Auth::attempt($req->validated())) {
            $user = Auth::user();
            return response()->json([
                "username" => $user->username,
                "token" => $user->createToken("API_TOKEN")->plainTextToken
            ], 200);
        }

    }
}
