<?php

namespace App\Models\Helpers\ImagePreview;

use Intervention\Image\ImageManagerStatic as Image;

class ImagePreview
{
    /**
     * @var ImagePreviewResizer
     */
    protected $imageResizer;

    /**
     * @var ImagePreviewSaver
     */
    protected $imagePreviewSaver;

    /**
     * Create a new instance of ImagePreview
     *
     * @param ImagePreviewResizer $imageResizer
     * @param ImagePreviewSaver $imagePreviewSaver
     */
    public function __construct(
        ImagePreviewResizer $imageResizer,
        ImagePreviewSaver $imagePreviewSaver
    )
    {
        $this->imageResizer = $imageResizer;
        $this->imagePreviewSaver = $imagePreviewSaver;
    }

    /**
     * Create a preview given a path to image
     *
     * @param string $pathToImage
     */
    public function create(string $pathToImage): void
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

    /**
     * Create a preview name based on $pathToImage
     *
     * @param $pathToImage
     * @return string
     */
    protected function createPreviewName($pathToImage): string
    {
        $pathArray = explode("/", $pathToImage);
        $explodedPath = array_values(array_slice($pathArray, -3));
        $previewName = implode("/", $explodedPath);

        return $previewName;
    }
}