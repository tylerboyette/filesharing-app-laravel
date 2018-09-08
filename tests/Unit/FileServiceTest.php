<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileServiceTest extends TestCase
{
    protected $fileService;

    public function setUp()
    {
        parent::setUp();
        $this->fileService = $this->app->make("App\Models\Services\FileService");
    }

    /** @test */
    public function handles_uploaded_file()
    {
        Storage::fake("local");
        $file = UploadedFile::fake()->image('test.jpg', 1500, 1000)->size(100);

        $path = $this->fileService->handleUploadedFile($file);

        Storage::disk("local")->assertExists($path);
    }
}
