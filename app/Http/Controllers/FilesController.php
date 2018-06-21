<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class FilesController extends Controller
{
    public function store(FileUploadRequest $request)
    {
        dd($request);
    }
}
