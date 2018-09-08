<?php

namespace Tests\Unit;

use Tests\TestCase;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Testing\FileFactory;

class ImagePreviewSaverTest extends TestCase
{
    protected $imageSaver;

    public function setUp()
    {
        parent::setUp();
        $this->imageSaver = $this->app->make("App\Models\Helpers\ImagePreview\ImagePreviewSaver");
    }

    /** @test */
    public function can_save_image_preview()
    {
        $image = (new FileFactory())->image("test.jpg",500, 300);
        $interventionImage = Image::make($image);
        Storage::fake("local");
        $savePath = storage_path("app/public/image_previews");
        $saveName = "test.jpg";

        $path = $this->imageSaver->save($interventionImage, $savePath,$saveName);

        Storage::disk("local")->assertExists($path);
    }
}
