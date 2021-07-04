<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Post;
use App\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    public function store(Post $post, Request $request, PostComment $comment)
    {

        $comment->body = $request->body;
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->save();

        $comments = PostComment::where('post_id', $post->id)
        ->orderByDesc('created_at')
        ->get();
        return $comments;
    }

    public function destroy()
    {

    }
}
