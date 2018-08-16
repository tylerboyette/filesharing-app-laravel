<?php

namespace App\Models\Helpers;

use Intervention\Image\ImageManagerStatic as Image;

class ImagePreview
{
    public function create($pathToImage): void
    {
        $preview = Image::make($pathToImage);
        $previewName = $this->createPreviewName($pathToImage);
        $imageInfo = getimagesize($pathToImage);
        $width = $imageInfo[0];
        $height = $imageInfo[1];

        if ($width <= 550 && $height <= 550) {
            $preview->save(storage_path("app/public/image_previews/$previewName"));
        } elseif ($width > $height) {
            $preview->resize(550,null, function($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/public/image_previews/$previewName"));
        } else {
            $preview->resize(null,550, function($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/public/image_previews/$previewName"));
        }
    }

    protected function createPreviewName($pathToImage)
    {
        $pathArray = explode("/", $pathToImage);
        $previewName = array_values(array_slice($pathArray, -1))[0];

        return $previewName;
    }
}