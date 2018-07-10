<?php

namespace App\Models\Services;

use App\Models\Entities\File;
use App\Models\Helpers\FileMediaInfo;
use Illuminate\Support\Facades\Auth;

class FileService
{
    protected $getId3;
    protected $fileMediaInfo;

    public function __construct(FileMediaInfo $fileMediaInfo)
    {
        $this->getId3 = new \getID3();
        $this->fileMediaInfo = $fileMediaInfo;
    }

    public function handleUploadedFile($file)
    {
        $currentYearMonth = date("Y/m");

        // Storing file
        $pathToFile = $file->storeAs("files/{$currentYearMonth}", $this->makeFileName($file));

        // Getting file meta data
        $fileMetaData = $this->fileMediaInfo->bundleFileMetaData(storage_path("app/".$pathToFile));

        File::create([
           "original_name" => $file->getClientOriginalName(),
           "storage_name" => str_replace("files/", "", $pathToFile),
           "extension" => $file->getClientOriginalExtension(),
           "meta_data" => $fileMetaData,
           "user_id" => $this->getUploaderId()
        ]);
    }

    /**
     * @return int|null
     */
    public function getUploaderId()
    {
        if (Auth::check()) {
            return Auth::user()->id;
        }

        return null;
    }

    public function makeFileName($file): string
    {
        return time() . "." . $file->getClientOriginalExtension();
    }
}