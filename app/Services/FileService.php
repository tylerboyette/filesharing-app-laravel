<?php

namespace App\Services;

class FileService
{
    protected $getId3;

    public function __construct()
    {
        $this->getId3 = new \getID3();
    }

    public function handleUploadedFile($file)
    {
        // Data to be inserted in DB
        $metaDataForDB = [];

        $originalName = $file->getClientOriginalName();
        $originalExtension = $file->getClientOriginalExtension();

        // Storing file
        $pathToFile = $file->storeAs("files", $this->makeFileName($file));

        // Analyzing the file
        $fileInfo = $this->getId3->analyze(storage_path("app/".$pathToFile));

        // Getting the MIME-type of the file
        $mimeType = $fileInfo["mime_type"];

        $metaDataForDB["filesize"] = $fileInfo["filesize"];
        $metaDataForDB["extension"] = $originalExtension;

        // Exploding the MIME-type by "/" and getting the first part of the MIME-type
        $fileType = explode("/", $mimeType)[0];
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
    }

    public function makeFileName($file)
    {
        return time() . "." . $file->getClientOriginalExtension();
    }
}