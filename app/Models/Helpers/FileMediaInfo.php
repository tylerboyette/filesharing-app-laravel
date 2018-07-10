<?php

namespace App\Models\Helpers;

class FileMediaInfo
{
    protected $getId3;

    public function __construct()
    {
        $this->getId3 = new \getID3();
    }

    public function bundleFileMetaData(string $pathToFile): array
    {
        $fileInfo = $this->getId3->analyze($pathToFile);

        $fileMetaData = [];

        if (array_key_exists("mime_type", $fileInfo)) {
            // Getting the MIME-type of the file
            $mimeType = $fileInfo["mime_type"];

            // Exploding the MIME-type by "/" and getting the first part of the MIME-type
            $fileType = explode("/", $mimeType)[0];

            // Getting additional meta data for media files
            $fileMetaData = $this->grabMetaDataByFileType($fileType, $fileInfo);

            // Storing MIME-type in meta data
            $fileMetaData["mime_type"] = $mimeType;
        }

        $fileMetaData["filesize"] = $fileInfo["filesize"];

        return $fileMetaData;
    }

    protected function grabMetaDataByFileType(string $fileType, array $fileInfo): array
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
}