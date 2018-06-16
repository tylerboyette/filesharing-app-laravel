<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;


class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::where("id", $id)->firstOrFail();

        return view("users.show", ["user" => $user]);
    }

    public function updateAvatar(AvatarUpdateRequest $request)
    {
        // Renaming, resizing image and saving to the public disk
        $avatar = $request->file("avatar");
        $filename = time() . "." . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(
            300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(
            public_path("/uploads/avatars/" . $filename)
        );

        $user = Auth::user();

        $previousUserAvatarName = $user->avatar_name;

        // Saving new avatar to the database
        $user->avatar_name = $filename;
        $user->save();

        // Deleting previous avatar from the storage
        if ($previousUserAvatarName !== "default.png") {
            File::delete(public_path("/uploads/avatars/" . $previousUserAvatarName));
        }

        return back();
    }
}
