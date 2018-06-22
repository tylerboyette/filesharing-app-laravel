<?php

namespace App\Services;

class FileService
{
    public function handleUploadedFile($file)
    {
        $originalName = $file->getClientOriginalName();
        $originalExtenstion = $file->getClientOriginalExtension();

        $requiredMetaData = [
          "all" => "filesize",
          "audio" => [
              "general" => "playtime_string",
              "audio" => "bitrate|sample_rate|channels|codec"
          ],
          "video" => [
              "general" => "playtime_string",
              "audio" => "sample_rate|channels|codec",
              "video" => "resolution_x|resolution_y"
          ],
          "image" => [
              "general" => "fileformat",
              "video" => "bits_per_sample"
          ]
        ];
    }

    public function makeFileName($file)
    {
        return time() . "." . $file->getClientOriginalExtension();
    }
}