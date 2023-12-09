<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function login_post(LoginRequest $req): RedirectResponse
    {

        if (Auth::attempt($req->validated())) {
            return redirect("/");
        } else {
            return Redirect::back()->withErrors(['msg' => __("messages.wrong_credentials")]);
        }


    }
}
