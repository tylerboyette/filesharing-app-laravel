<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Services\FileService;

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
        //$this->fileService->handleUploadedFile($request->file("file"));

        //return redirect()->home();
        return response()->json(["success" => "success"]);
    }
}
