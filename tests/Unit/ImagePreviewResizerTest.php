<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Helpers\ImagePreview\ImagePreviewResizer;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Testing\FileFactory;

class ImagePreviewResizerTest extends TestCase
{
    /** @test */
    public function does_not_resize_images_with_legit_size()
    {
        $imagePreviewResizer = new ImagePreviewResizer();
        $image = (new FileFactory())->image("test.jpg",500, 300);
        $interventionImage = Image::make($image);
        $initialWidth = $interventionImage->width();
        $initialHeight = $interventionImage->height();

        $imagePreviewResizer->resize($interventionImage);

        $outputWidth = $interventionImage->width();
        $outputHeight = $interventionImage->height();

        $this->assertTrue($initialWidth === $outputWidth && $initialHeight === $outputHeight);
    }
}
