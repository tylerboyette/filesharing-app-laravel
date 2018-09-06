<?php

namespace App\Models\Helpers;

use Intervention\Image\ImageManagerStatic as Image;

class ImagePreview
{
    protected $imageResizer;

    public function __construct(ImagePreviewResizer $imageResizer)
    {
        $this->imageResizer = $imageResizer;
    }

    public function create($pathToImage): void
    {
        $preview = Image::make($pathToImage);
        $previewName = $this->createPreviewName($pathToImage);
        $imageInfo = getimagesize($pathToImage);
        $width = $imageInfo[0];
        $height = $imageInfo[1];

        $this->imageResizer->resizePreviewBasedOnWidthHeight($preview, $width, $height);
        $this->savePreviewToPath($preview,storage_path("app/public/image_previews/$previewName"));
    }

    protected function createPreviewName($pathToImage)
    {
        $pathArray = explode("/", $pathToImage);
        $explodedPath = array_values(array_slice($pathArray, -3));
        $previewName = implode("/", $explodedPath);

        return $previewName;
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