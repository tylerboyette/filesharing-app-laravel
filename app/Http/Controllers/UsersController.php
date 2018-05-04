<?php

namespace App\Http\Controllers;

use App\User;


class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::where("id", $id)->firstOrFail();

        return view("users.show", ["user" => $user]);
    }
}
