<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Services\FileService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


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

        /*
        $ext = $request->file("file")->getClientOriginalExtension();
        $request->file("file")->storeAs("files","1" . "." . $ext);

        dd($this->getId3->analyze(storage_path("app/files/1.{$ext}")));
        */
    }
}
