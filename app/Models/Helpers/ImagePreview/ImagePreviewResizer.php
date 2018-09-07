<?php

namespace App\Models\Helpers\ImagePreview;

use Intervention\Image\Image;

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
     * Resize preview comparing the actual dimensions with $maxWidth and $maxHeight.
     *
     * @param $preview
     * @return mixed
     */
    public function resize(Image $preview)
    {
        if ($preview->width() <= $this->maxWidth && $preview->height() <= $this->maxHeight) {
            return $preview;
        } elseif ($preview->width() > $preview->height()) {
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