<?php

namespace App\Http\Controllers;

use App\Models\Entities\User;

class UsersController extends Controller
{
    /**
     * Show a user page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::where("id", $id)->firstOrFail();
        $files = $user->files;
        $fileCount = $files->count();

        return view("users.show", ["user" => $user, "files" => $files, "fileCount" => $fileCount]);
    }
}
