<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view("registration.create");
    }

    public function store(RegistrationRequest $request)
    {
        $hashedPassword = Hash::make($request->input("password"));

        $user = User::create([
            "username" => $request->input("username"),
            "email" => $request->input("email"),
            "password" => $hashedPassword,
            "avatar_name" => "default.png"
        ]);

        auth()->login($user);

        return redirect()->home();
    }
}
