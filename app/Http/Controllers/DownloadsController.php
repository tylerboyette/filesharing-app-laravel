<?php

namespace App\Http\Controllers;

use App\Models\Entities\File;

class DownloadsController extends Controller
{
    /**
     * Download a file
     *
     * @param $fileId
     */
    public function index($fileId)
    {
        $file = File::where("id", $fileId)->firstOrFail();
        $size = $file->meta_data["filesize"];
        $contentType = array_key_exists("mime_type",$file->meta_data) ?
            $file->meta_data["mime_type"] :
            "application/octet-stream";

        header('Content-Description: File Transfer');
        header("Content-Type: $contentType");
        header("Content-Disposition: attachment");
        header("Content-Length: $size");

        readfile(
            storage_path("app/files/$file->storage_name")
        );
        exit;
    }
}
