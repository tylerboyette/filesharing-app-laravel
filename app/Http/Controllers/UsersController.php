<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarUpdateRequest;
use App\Models\Services\AvatarService;
use App\Models\Entities\User;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    protected $avatarService;

    public function __construct(AvatarService $avatarService)
    {
        $this->middleware("auth")->only("updateAvatar");
        $this->avatarService = $avatarService;
    }

    public function show($id)
    {
        $user = User::where("id", $id)->firstOrFail();
        $files = $user->files;
        $fileCount = $files->count();

        return view("users.show", ["user" => $user, "files" => $files, "fileCount" => $fileCount]);
    }

    public function updateAvatar(AvatarUpdateRequest $request)
    {
        $avatar = $request->file("avatar");
        if (!is_null($avatar)) {
            $this->avatarService->handleUploadedAvatar($avatar);

            $user = Auth::user();

            $previousUserAvatarName = $user->avatar_name;

            // Saving new avatar to the database
            $user->avatar_name = $this->avatarService->getAvatarName();
            $user->save();

            $this->avatarService->deleteAvatarFromStorage($previousUserAvatarName);
        }

        return response()->json(["success" => "success"]);
    }
}
