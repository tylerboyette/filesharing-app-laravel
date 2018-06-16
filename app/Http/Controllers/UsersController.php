<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarUpdateRequest;
use App\Services\AvatarService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class UsersController extends Controller
{
    protected $avatarService;

    public function __construct(AvatarService $avatarService)
    {
        $this->avatarService = $avatarService;
    }

    public function show($id)
    {
        $user = User::where("id", $id)->firstOrFail();

        return view("users.show", ["user" => $user]);
    }

    public function updateAvatar(AvatarUpdateRequest $request)
    {
        $avatar = $request->file("avatar");
        $this->avatarService->handleUploadedAvatar($avatar);
        $filename = $this->avatarService->makeAvatarName($avatar);

        $user = Auth::user();

        $previousUserAvatarName = $user->avatar_name;

        // Saving new avatar to the database
        $user->avatar_name = $filename;
        $user->save();

        $this->avatarService->deleteAvatarFromStorage($previousUserAvatarName);

        return back();
    }
}
