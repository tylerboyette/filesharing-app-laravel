<?php

namespace App\Models\Helpers\ImagePreview;

use Intervention\Image\Image;

class ImagePreviewSaver
{
    /**
     * Save an image preview under $saveName to $savePath.
     * Creates necessary folders if $savePath does not exist.
     *
     * @param $preview
     * @param string $savePath
     * @param string $saveName
     */
    public function save(Image $preview, string $savePath, string $saveName): void
    {
        if (!file_exists($savePath)) {
            mkdir($savePath, 0777, true);
        }

        $preview->save($savePath."/".$saveName);
    }
}