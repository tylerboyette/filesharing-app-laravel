<?php

namespace App\Models\Helpers\ImagePreview;

class ImagePreviewResizer
{
    /**
     * @var int
     */
    protected $maxWidth = 550;

    /**
     * @var int
     */
    protected $maxHeight = 550;

    /**
     * Resize preview comparing the actual dimensions with $maxWidth and $maxHeight
     *
     * @param $preview
     * @param int $width
     * @param int $height
     * @return mixed
     */
    public function resizePreviewBasedOnWidthHeight($preview, int $width, int $height)
    {
        if ($width <= $this->maxWidth && $height <= $this->maxHeight) {
            return $preview;
        } elseif ($width > $height) {
            $preview->resize($this->maxWidth, null, function($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $preview->resize(null, $this->maxHeight, function($constraint) {
                $constraint->aspectRatio();
            });
        }

        return $preview;
    }
}