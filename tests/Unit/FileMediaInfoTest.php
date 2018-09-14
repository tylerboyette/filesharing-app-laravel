<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class FileMediaInfoTest extends TestCase
{
    protected $fileMediaInfo;
    protected $testFileName = "test.jpg";
    protected $pathToTestFile = "files/test";

    public function setUp()
    {
        parent::setUp();
        $this->fileMediaInfo = $this->app->make("App\Models\Helpers\FileMediaInfo\FileMediaInfo");
    }

    public function tearDown()
    {
        if (Storage::disk("local")->exists("files/test")) {
            Storage::disk("local")->deleteDirectory("files/test");
        }
        parent::tearDown();
    }

    /** @test */
    public function bundles_file_metadata()
    {
        $file = UploadedFile::fake()->image($this->testFileName, 1500, 1000)->size(1000);
        $path = $file->storeAs($this->pathToTestFile, $this->testFileName);
        $metadata = $this->fileMediaInfo->bundleFileMetaData(storage_path("app/$path"));

        $this->assertTrue(is_array($metadata) && count($metadata));
    }
}
