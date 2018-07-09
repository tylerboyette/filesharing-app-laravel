<?php

namespace App\Services;

use App\File;
use Illuminate\Support\Facades\Auth;

class FileService
{
    protected $getId3;

    public function __construct()
    {
        $this->getId3 = new \getID3();
    }

    public function handleUploadedFile($file)
    {
        $currentYearMonth = date("Y/m");

        // Storing file
        $pathToFile = $file->storeAs("files/{$currentYearMonth}", $this->makeFileName($file));

        // Analyzing the file and getting the info
        $fileInfo = $this->getId3->analyze(storage_path("app/".$pathToFile));

        $metaDataForDB = $this->makeUpMetaDataForDB($fileInfo);

        File::create([
           "original_name" => $file->getClientOriginalName(),
           "storage_name" => str_replace("files/", "", $pathToFile),
           "extension" => $file->getClientOriginalExtension(),
           "meta_data" => $metaDataForDB,
           "user_id" => $this->getUploaderId()
        ]);
    }

    public function makeUpMetaDataForDB(array $fileInfo): array
    {
        $metaDataForDB = [];

        if (array_key_exists("mime_type", $fileInfo)) {
            // Getting the MIME-type of the file
            $mimeType = $fileInfo["mime_type"];

            // Exploding the MIME-type by "/" and getting the first part of the MIME-type
            $fileType = explode("/", $mimeType)[0];

            // Getting additional meta data for media files
            $metaDataForDB = $this->grabMetaDataByFileType($fileType, $fileInfo);

            // Storing MIME-type in meta data
            $metaDataForDB["mime_type"] = $mimeType;
        }

        $metaDataForDB["filesize"] = $fileInfo["filesize"];

        return $metaDataForDB;
    }

    public function grabMetaDataByFileType(string $fileType, array $fileInfo): array
    {
        $metaData = [];

        switch ($fileType) {
            case "audio":
                $audioParameters = [
                    "bitrate" => $fileInfo["audio"]["bitrate"],
                    "sample_rate" => $fileInfo["audio"]["sample_rate"],
                    "channels_count" => $fileInfo["audio"]["channels"],
                    "codec" => $fileInfo["audio"]["codec"]
                ];

                $metaData["playtime_string"] = $fileInfo["playtime_string"];
                $metaData["audio"] = $audioParameters;
                break;
            case "video":
                $audioParameters = [
                    "sample_rate" => $fileInfo["audio"]["sample_rate"],
                    "channels_count" => $fileInfo["audio"]["channels"],
                    "codec" => $fileInfo["audio"]["codec"]
                ];
                $videoParameters = [
                    "resolution_x" => $fileInfo["video"]["resolution_x"],
                    "resolution_y" => $fileInfo["video"]["resolution_y"]
                ];

                $metaData["playtime_string"] = $fileInfo["playtime_string"];
                $metaData["audio"] = $audioParameters;
                $metaData["video"] = $videoParameters;
                break;
            case "image":
                $videoParameters = [
                    "resolution_x" => $fileInfo["video"]["resolution_x"],
                    "resolution_y" => $fileInfo["video"]["resolution_y"]
                ];

                $metaData["fileformat"] = $fileInfo["fileformat"];
                $metaData["video"] = $videoParameters;
                break;
        }

        return $metaData;
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