<?php

namespace Tests\Unit;

use Tests\TestCase;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Testing\FileFactory;

class ImagePreviewResizerTest extends TestCase
{
    protected $imagePreviewResizer;

    public function setUp()
    {
        parent::setUp();
        $this->imagePreviewResizer = $this->app->make("App\Models\Helpers\ImagePreview\ImagePreviewResizer");
    }

    /** @test */
    public function does_not_resize_images_with_legit_size()
    {
        $image = (new FileFactory())->image("test.jpg",500, 300);
        $interventionImage = Image::make($image);
        $initialWidth = $interventionImage->width();
        $initialHeight = $interventionImage->height();

        $this->imagePreviewResizer->resize($interventionImage);

        $outputWidth = $interventionImage->width();
        $outputHeight = $interventionImage->height();

        $this->assertTrue($initialWidth === $outputWidth && $initialHeight === $outputHeight);
    }

    /** @test */
    public function resizes_image_of_inappropriate_width()
    {
        $image = (new FileFactory())->image("test.jpg",1200, 800);
        $interventionImage = Image::make($image);

        $this->imagePreviewResizer->resize($interventionImage);

        $outputWidth = $interventionImage->width();
        $outputHeight = $interventionImage->height();

        $this->assertTrue($outputWidth <= 550 && $outputWidth >= $outputHeight);
    }

    /** @test */
    public function resizes_image_of_inappropriate_height()
    {
        $image = (new FileFactory())->image("test.jpg",800, 1200);
        $interventionImage = Image::make($image);

        $this->imagePreviewResizer->resize($interventionImage);

        $outputWidth = $interventionImage->width();
        $outputHeight = $interventionImage->height();

        $this->assertTrue($outputHeight <= 550 && $outputHeight >= $outputWidth);
    }
}
