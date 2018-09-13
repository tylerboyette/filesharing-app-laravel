<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Testing\FileFactory;
use Illuminate\Support\Facades\Storage;

class ImagePreviewTest extends TestCase
{
    protected $imagePreview;
    protected $testImageName = "test.jpg";
    protected $testImagePath = "files/2018/09";
    protected $testPreviewPath = "public/image_previews/2018/09";

    public function setUp()
    {
        parent::setUp();
        $this->imagePreview = $this->app->make("App\Models\Helpers\ImagePreview\ImagePreview");
    }

    public function tearDown()
    {
        if (Storage::disk("local")->exists($this->testImagePath."/".$this->testImageName)) {
            Storage::disk("local")->delete($this->testImagePath."/".$this->testImageName);
        }

        if (Storage::disk("local")->exists($this->testPreviewPath."/".$this->testImageName)) {
            Storage::disk("local")->delete($this->testPreviewPath."/".$this->testImageName);
        }
        parent::tearDown();
    }

    /** @test */
    public function can_create_image_preview()
    {
        $image = (new FileFactory())->image($this->testImageName, 1500, 800);
        $path = $image->storeAs($this->testImagePath, $this->testImageName);
        $this->imagePreview->create(storage_path("app/$path"));

        Storage::disk("local")->assertExists($this->testPreviewPath."/".$this->testImageName);
    }
}
