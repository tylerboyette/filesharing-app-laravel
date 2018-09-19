<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarUpdateRequest;
use App\Models\Services\AvatarService;
use Illuminate\Support\Facades\Auth;

class AvatarsController extends Controller
{
    /**
     * @var AvatarService
     */
    protected $avatarService;

    /**
     * Create a new UsersController instance
     *
     * @param AvatarService $avatarService
     */
    public function __construct(AvatarService $avatarService)
    {
        $this->middleware("auth")->only("update");
        $this->avatarService = $avatarService;
    }

    /**
     * Update user's avatar
     *
     * @param AvatarUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AvatarUpdateRequest $request)
    {
        $avatar = $request->file("avatar");
        if (!is_null($avatar)) {
            $this->avatarService->handleUploadedFile($avatar);

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
