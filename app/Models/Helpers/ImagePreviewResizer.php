<?php

namespace App\Models\Helpers;

class ImagePreviewResizer
{
    protected $requiredWidth = 550;
    protected $requiredHeight = 550;

    public function resizePreviewBasedOnWidthHeight($preview, int $width, int $height)
    {
        if ($width <= $this->requiredWidth && $height <= $this->requiredHeight) {
            return $preview;
        } elseif ($width > $height) {
            $preview->resize($this->requiredWidth, null, function($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $preview->resize(null, $this->requiredHeight, function($constraint) {
                $constraint->aspectRatio();
            });
        }

        return $preview;
    }
}