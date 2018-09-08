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
     * @return string  Path to the saved preview
     */
    public function save(Image $preview, string $savePath, string $saveName): string
    {
        if (!file_exists($savePath)) {
            mkdir($savePath, 0777, true);
        }

        $fullPath = $savePath."/".$saveName;

        $preview->save($fullPath);

        return $fullPath;
    }
}