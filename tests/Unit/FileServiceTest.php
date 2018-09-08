<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Services\FileService;
use App\Models\Helpers\FileMediaInfo\FileMediaInfo;
use App\Models\Helpers\FileMediaInfo\MetaDataGrabber;
use App\Models\Helpers\FileMediaInfo\FileIcon;
use App\Models\Helpers\ImagePreview\ImagePreview;
use App\Models\Helpers\ImagePreview\ImagePreviewResizer;
use App\Models\Helpers\ImagePreview\ImagePreviewSaver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileServiceTest extends TestCase
{
    /** @test */
    public function handles_uploaded_file()
    {
        $fileMediaInfo = new FileMediaInfo(new MetaDataGrabber());
        $imagePreview = new ImagePreview(
            new ImagePreviewResizer(),
            new ImagePreviewSaver()
        );
        $fileService = new FileService($fileMediaInfo, new FileIcon(), $imagePreview);
        Storage::fake("local");
        $file = UploadedFile::fake()->image('test.jpg', 1500, 1000)->size(100);

        $path = $fileService->handleUploadedFile($file);

        Storage::disk("local")->assertExists($path);
    }
}
