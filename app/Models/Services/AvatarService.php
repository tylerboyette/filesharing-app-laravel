<?php

namespace App\Models\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class AvatarService
{
    public function handleUploadedAvatar($avatar)
    {
        $filename = $this->makeAvatarName($avatar);

        Image::make($avatar)->resize(
            300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(
            public_path("/uploads/avatars/" . $filename)
        );
    }

    public function makeAvatarName($avatar)
    {
        return time() . "." . $avatar->getClientOriginalExtension();
    }

    public function deleteAvatarFromStorage($avatarName)
    {
        if ($avatarName !== "default.png") {
            File::delete(public_path("/uploads/avatars/" . $avatarName));
        }
    }
}
