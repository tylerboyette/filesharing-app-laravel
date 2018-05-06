<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::where("id", $id)->firstOrFail();

        return view("users.show", ["user" => $user]);
    }

    public function updateAvatar(Request $request)
    {
        if ($request->hasFile("avatar")) {
            $request->validate([
                "avatar" => "image|mimes:jpg,png,jpeg"
            ]);

            $avatar = $request->file("avatar");
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(150, 150)->save(
                public_path("/uploads/avatars/" . $filename)
            );

            $user = Auth::user();

            $user->avatar_name = $filename;

            $user->save();
        }

        return back();
    }
}
