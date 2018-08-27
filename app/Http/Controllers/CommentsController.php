<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Entities\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(CommentRequest $request)
    {
        $user_id = Auth::check() ? Auth::user()->id : null;

        $comment = Comment::create([
            "content" => $request->input("content"),
            "file_id" => $request->input("file_id"),
            "user_id" => $user_id
        ]);

        $comment->save();

        return back();
    }
}
