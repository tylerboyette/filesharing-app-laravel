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

        $this->resizePreviewBasedOnWidthHeight($preview, $width, $height);
        $this->savePreviewToPath($preview,storage_path("app/public/image_previews/$previewName"));
    }

    protected function createPreviewName($pathToImage)
    {
        $pathArray = explode("/", $pathToImage);
        $explodedPath = array_values(array_slice($pathArray, -3));
        $previewName = implode("/", $explodedPath);

        return $previewName;
    }

    protected function resizePreviewBasedOnWidthHeight($preview, int $width, int $height)
    {
        if ($width <= 550 && $height <= 550) {
            return $preview;
        } elseif ($width > $height) {
            $preview->resize(550, null, function($constraint) {
                $constraint->aspectRatio();
            });

            return $preview;
        } else {
            $preview->resize(null,550, function($constraint) {
                $constraint->aspectRatio();
            });

            return $preview;
        }
    }

    protected function savePreviewToPath($preview, string $path)
    {
        $pathArray = explode("/", $path);
        array_pop($pathArray);
        $savePath = implode("/", $pathArray);

        if (!file_exists($savePath)) {
            mkdir($savePath, 0777, true);
        }

        $preview->save($path);
    }
}