<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\Services\FileService;
use App\Models\Entities\File;


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

    public function showFilesList()
    {
        $lastFiles = File::orderBy("id", "desc")->take(100)->get();

        return view("files.showFilesList", ["files" => $lastFiles]);
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
