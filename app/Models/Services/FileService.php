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
    /**
     * @var FileMediaInfo
     */
    protected $fileMediaInfo;

    /**
     * @var FileIcon
     */
    protected $fileIcon;

    /**
     * @var ImagePreview
     */
    protected $imagePreview;

    /**
     * Create a new FileService instance
     *
     * @param FileMediaInfo $fileMediaInfo
     * @param FileIcon $fileIcon
     * @param ImagePreview $imagePreview
     */
    public function __construct(
        FileMediaInfo $fileMediaInfo,
        FileIcon $fileIcon,
        ImagePreview $imagePreview
    )
    {
        $this->getId3 = new \getID3();
        $this->fileMediaInfo = $fileMediaInfo;
        $this->fileIcon = $fileIcon;
        $this->imagePreview = $imagePreview;
    }

    /**
     * Store an uploaded file and save it to the database
     *
     * @param $file
     * @return void
     */
    public function handleUploadedFile($file): void
    {
        $currentYearMonth = date("Y/m");
        $fileExtension = $file->getClientOriginalExtension();

        // Storing file
        $pathToFile = $file->storeAs("files/{$currentYearMonth}", $this->makeFileName($file));

        // Getting file meta data
        $fileMetaData = $this->fileMediaInfo->bundleFileMetaData(storage_path("app/".$pathToFile));

        // Determining whether there is a related SVG icon for presented file extension
        $hasRelatedIcon = $this->fileIcon->hasRelatedIcon($fileExtension) ? 1 : 0;


        if (array_key_exists("mime_type",$fileMetaData)
            && explode("/",$fileMetaData["mime_type"])[0] === "image") {
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
     * Get the id of the uploader if the upload wasn't anonymous
     *
     * @return int|null
     */
    public function getUploaderId()
    {
        if (Auth::check()) {
            return Auth::user()->id;
        }

        return null;
    }

    /**
     * Create a name for the file
     *
     * @param $file
     * @return string
     */
    public function makeFileName($file): string
    {
        return time() . "." . $file->getClientOriginalExtension();
    }
}