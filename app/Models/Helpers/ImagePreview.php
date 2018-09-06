<?php

namespace App\Models\Helpers;

use Intervention\Image\ImageManagerStatic as Image;

class ImagePreview
{
    protected $imageResizer;
    protected $imagePreviewSaver;

    public function __construct(
        ImagePreviewResizer $imageResizer,
        ImagePreviewSaver $imagePreviewSaver
    )
    {
        $this->imageResizer = $imageResizer;
        $this->imagePreviewSaver = $imagePreviewSaver;
    }

    public function create($pathToImage): void
    {
        $preview = Image::make($pathToImage);
        $previewName = $this->createPreviewName($pathToImage);
        $imageInfo = getimagesize($pathToImage);
        $width = $imageInfo[0];
        $height = $imageInfo[1];

        $this->imageResizer->resizePreviewBasedOnWidthHeight($preview, $width, $height);

        $pathArray = explode("/", storage_path("app/public/image_previews/$previewName"));
        $saveName = array_pop($pathArray);
        $savePath = implode("/", $pathArray);

        $this->imagePreviewSaver->save($preview, $savePath, $saveName);
    }

    protected function createPreviewName($pathToImage)
    {
        $pathArray = explode("/", $pathToImage);
        $explodedPath = array_values(array_slice($pathArray, -3));
        $previewName = implode("/", $explodedPath);

        return $previewName;
    }
}