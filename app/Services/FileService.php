<?php

namespace App\Services;

use App\File;

class FileService
{
    protected $getId3;

    public function __construct()
    {
        $this->getId3 = new \getID3();
    }

    public function handleUploadedFile($file)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        // Storing file
        $pathToFile = $file->storeAs("files", $this->makeFileName($file));

        // Analyzing the file and getting the info
        $fileInfo = $this->getId3->analyze(storage_path("app/".$pathToFile));

        $metaDataForDB = $this->makeUpMetaDataForDB($fileInfo);

        File::create([
           "original_name" => $originalName,
           "storage_name" => $pathToFile,
           "extension" => $extension,
           "meta_data" => $metaDataForDB
        ]);
    }

    public function makeUpMetaDataForDB(array $fileInfo): array
    {
        $metaDataForDB = [];

        // Getting the MIME-type of the file
        $mimeType = $fileInfo["mime_type"];

        // Exploding the MIME-type by "/" and getting the first part of the MIME-type
        $fileType = explode("/", $mimeType)[0];
        
        $metaDataForDB["filetype"] = $fileType;
        $metaDataForDB["filesize"] = $fileInfo["filesize"];

        switch ($fileType) {
            case "audio":
                $audioParameters = [
                    "bitrate" => $fileInfo["audio"]["bitrate"],
                    "sample_rate" => $fileInfo["audio"]["sample_rate"],
                    "channels_count" => $fileInfo["audio"]["channels"],
                    "codec" => $fileInfo["audio"]["codec"]
                ];

                $metaDataForDB["playtime_string"] = $fileInfo["playtime_string"];
                $metaDataForDB["audio"] = $audioParameters;
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

                $metaDataForDB["playtime_string"] = $fileInfo["playtime_string"];
                $metaDataForDB["audio"] = $audioParameters;
                $metaDataForDB["video"] = $videoParameters;
                break;
            case "image":
                $videoParameters = [
                    "resolution_x" => $fileInfo["video"]["resolution_x"],
                    "resolution_y" => $fileInfo["video"]["resolution_y"]
                ];

                $metaDataForDB["fileformat"] = $fileInfo["fileformat"];
                $metaDataForDB["video"] = $videoParameters;
                break;
        }

        return $metaDataForDB;
    }

    public function makeFileName($file): string
    {
        return time() . "." . $file->getClientOriginalExtension();
    }
}