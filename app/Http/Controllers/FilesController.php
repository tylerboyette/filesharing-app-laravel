<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class FilesController extends Controller
{
    protected $getId3;

    public function __construct()
    {
        $this->getId3 = new \getID3();
    }

    public function store(FileUploadRequest $request)
    {
        $ext = $request->file("file")->getClientOriginalExtension();
        $request->file("file")->storeAs("files","1" . "." . $ext);

        dd($this->getId3->analyze(storage_path("app/files/1.{$ext}")));
    }
}
