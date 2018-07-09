<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;
use App\File;


class FilesController extends Controller
{
    protected $getId3;
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->getId3 = new \getID3();
        $this->fileService = $fileService;
    }

    public function store(FileUploadRequest $request)
    {
        $this->fileService->handleUploadedFile($request->file("file"));

        return response()->json(["success" => "success"]);
    }

    public function show($id)
    {
        $file = File::where("id", $id)->firstOrFail();

        return view("files.show", ["file" => $file]);
    }

    public function downloadFile($id)
    {
        $file = File::where("id", $id)->firstOrFail();
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
