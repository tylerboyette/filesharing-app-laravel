<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest", ["except" => "destroy"]);
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->only("email", "password");

        if (!Auth::attempt($credentials)) {
            return response()->json(["error" => "Invalid credentials."]);
        }

        return response()->json(["success" => "Logged in."]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}
