<?php

namespace App\Models\Services;

use App\Models\Entities\File;
use App\Models\Helpers\FileMediaInfo;
use App\Models\Helpers\FileIcon;
use App\Models\Helpers\ImagePreview;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class FileService
{
    protected $getId3;
    protected $fileMediaInfo;
    protected $fileIcon;
    protected $imagePreview;

    public function __construct(FileMediaInfo $fileMediaInfo, FileIcon $fileIcon, ImagePreview $imagePreview)
    {
        $this->getId3 = new \getID3();
        $this->fileMediaInfo = $fileMediaInfo;
        $this->fileIcon = $fileIcon;
        $this->imagePreview = $imagePreview;
    }

    public function handleUploadedFile($file)
    {
        $currentYearMonth = date("Y/m");
        $fileExtension = $file->getClientOriginalExtension();

        // Storing file
        $pathToFile = $file->storeAs("files/{$currentYearMonth}", $this->makeFileName($file));

        // Getting file meta data
        $fileMetaData = $this->fileMediaInfo->bundleFileMetaData(storage_path("app/".$pathToFile));

        // Determining whether there is a related SVG icon for presented file extension
        $hasRelatedIcon = $this->fileIcon->hasRelatedIcon($fileExtension) ? 1 : 0;


        if (explode("/",$fileMetaData["mime_type"] === "image")) {
            $this->imagePreview->create(storage_path("app/$pathToFile"));
        }

        File::create([
           "original_name" => $file->getClientOriginalName(),
           "storage_name" => str_replace("files/", "", $pathToFile),
           "extension" => $fileExtension,
           "meta_data" => $fileMetaData,
           "has_related_icon" => $hasRelatedIcon,
           "user_id" => $this->getUploaderId()
        ]);
    }

    /**
     * TODO
     *
     * @param $image
     */
    public function createImagePreview($image) {

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