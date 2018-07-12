<?php

namespace App\Models\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class AvatarService
{
    public function handleUploadedAvatar($avatar)
    {
        $filename = $this->makeAvatarName($avatar);

        Image::make($avatar)->fit(
            300, 300
        )->save(
            storage_path("app/public/avatars/" . $filename)
        );
    }

    public function makeAvatarName($avatar)
    {
        return time() . "." . $avatar->getClientOriginalExtension();
    }

    public function deleteAvatarFromStorage($avatarName)
    {
        if ($avatarName !== "default.png") {
            File::delete(storage_path("app/public/avatars/" . $avatarName));
        }
    }
}
