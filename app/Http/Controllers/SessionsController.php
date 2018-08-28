<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware("guest", ["except" => "destroy"]);
    }

    /**
     * Log user in
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only("email", "password");

        if (!Auth::attempt($credentials)) {
            return response()->json(["error" => "Invalid credentials."]);
        }

        return response()->json(["success" => "Logged in."]);
    }

    /**
     * Log user out
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        auth()->logout();

        return back();
    }
}
