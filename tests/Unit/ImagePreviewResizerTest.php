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

    /** @test */
    public function resizes_image_of_inappropriate_width()
    {
        $imagePreviewResizer = new ImagePreviewResizer();
        $image = (new FileFactory())->image("test.jpg",1200, 800);
        $interventionImage = Image::make($image);

        $imagePreviewResizer->resize($interventionImage);

        $outputWidth = $interventionImage->width();
        $outputHeight = $interventionImage->height();

        $this->assertTrue($outputWidth <= 550 && $outputWidth >= $outputHeight);
    }

    /** @test */
    public function resizes_image_of_inappropriate_height()
    {
        $imagePreviewResizer = new ImagePreviewResizer();
        $image = (new FileFactory())->image("test.jpg",800, 1200);
        $interventionImage = Image::make($image);

        $imagePreviewResizer->resize($interventionImage);

        $outputWidth = $interventionImage->width();
        $outputHeight = $interventionImage->height();

        $this->assertTrue($outputHeight <= 550 && $outputHeight >= $outputWidth);
    }
}
