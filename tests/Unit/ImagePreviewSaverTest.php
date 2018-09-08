<?php

namespace Tests\Unit;

use Tests\TestCase;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Testing\FileFactory;

class ImagePreviewSaverTest extends TestCase
{
    protected $imageSaver;

    protected $pathToTestFile = "public/image_previews/test.jpg";

    public function setUp()
    {
        parent::setUp();
        $this->imageSaver = $this->app->make("App\Models\Helpers\ImagePreview\ImagePreviewSaver");
    }

    public function tearDown()
    {
        parent::tearDown();

        if (Storage::disk("local")->exists($this->pathToTestFile)) {
            Storage::disk("local")->delete($this->pathToTestFile);
        }
    }

    /** @test */
    public function can_save_image_preview()
    {
        $image = (new FileFactory())->image("test.jpg",500, 300);
        $interventionImage = Image::make($image);
        $savePath = storage_path("app/public/image_previews");
        $saveName = "test.jpg";

        $this->imageSaver->save($interventionImage, $savePath, $saveName);

        Storage::disk("local")->assertExists($this->pathToTestFile);
    }
}
