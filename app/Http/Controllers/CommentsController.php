<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Entities\Comment;
use App\Models\Entities\File;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Save a comment to the database
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Return a comment list for the file
     *
     * @param $fileId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($fileId)
    {
        $file = File::where("id", $fileId)->firstOrFail();
        $comments = $file->comments()->where("parent_id", null)->get();

        return view("files.partials.comment.list", ["comments" => $comments, "file" => $file]);
    }
}
