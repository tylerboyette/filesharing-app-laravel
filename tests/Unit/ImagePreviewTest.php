<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Testing\FileFactory;
use Illuminate\Support\Facades\Storage;

class ImagePreviewTest extends TestCase
{
    protected $imagePreview;

    public function setUp()
    {
        parent::setUp();
        $this->imagePreview = $this->app->make("App\Models\Helpers\ImagePreview\ImagePreview");
    }

    /** @test */
    public function can_create_image_preview()
    {
        $image = (new FileFactory())->image("test.jpg", 1500, 800);
        $path = $image->storeAs("files/2018/09", "test.jpg");
        $this->imagePreview->create(storage_path("app/$path"));

        Storage::disk("local")->assertExists("public/image_previews/2018/09/test.jpg");
    }
}
