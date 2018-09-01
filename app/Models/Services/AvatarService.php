<?php

namespace App\Models\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class AvatarService
{
    protected $avatarName;

    public function handleUploadedAvatar($avatar)
    {
        $this->avatarName = $this->makeAvatarName($avatar);

        Image::make($avatar)->fit(
            300, 300
        )->save(
            storage_path("app/public/avatars/" . $this->avatarName)
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

    public function getAvatarName()
    {
        return $this->avatarName;
    }
}
