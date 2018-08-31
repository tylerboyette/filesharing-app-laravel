<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Entities\Comment;
use App\Models\Entities\File;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(CommentRequest $request)
    {
        $user_id = Auth::check() ? Auth::user()->id : null;

        $comment = Comment::create([
            "content" => $request->input("content"),
            "file_id" => $request->input("file_id"),
            "user_id" => $user_id,
            "parent_id" => $request->input("parent_id")
        ]);

        $comment->save();

        return response()->json();
    }

    public function show($fileId)
    {
        $file = File::where("id", $fileId)->firstOrFail();
        $comments = $file->comments()->where("parent_id", null)->get();

        return view("files.partials.comment.list", ["comments" => $comments, "file" => $file]);
    }
}
