<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Entities\User;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware("guest");
    }

    /**
     * Register a new user
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        return response()->json(["success" => "You have successfully registered"]);
    }
}
