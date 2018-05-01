<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view("registration.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "username" => "required|alpha_dash|max:20|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:6"
        ]);

        $user = User::create(request(["name", "email", "password"]));

        auth()->login($user);

        return redirect()->home();
    }
}
