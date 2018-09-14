<?php

namespace App\Models\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class AvatarService extends FileService
{
    /**
     * @var string
     */
    protected $avatarName;

    /**
     * @var string
     */
    protected $defaultAvatarName = "default.png";

    /**
     * Store an uploaded avatar.
     *
     * @param $avatar
     * @return string  Path to uploaded avatar
     */
    public function handleUploadedFile($avatar): string
    {
        $this->avatarName = $this->makeFileName($avatar);
        $savePath = "public/avatars";

        if (!file_exists(storage_path("app/$savePath"))) {
            mkdir(storage_path("app/$savePath"), 0777, true);
        }

        Image::make($avatar)->fit(
            300, 300
        )->save(
            storage_path("app/$savePath/{$this->avatarName}")
        );

        return $savePath . "/" . $this->avatarName;
    }

    /**
     * Delete avatar from storage unless it is a default avatar.
     *
     * @param $avatarName
     */
    public function deleteAvatarFromStorage($avatarName): void
    {
        if ($avatarName !== $this->defaultAvatarName) {
            File::delete(storage_path("app/public/avatars/" . $avatarName));
        }
    }

    /**
     * Return an avatar name.
     *
     * @return string
     */
    public function getAvatarName(): string
    {
        return $this->avatarName;
    }
}
