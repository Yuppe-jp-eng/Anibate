<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Post;
use App\PostComment;
use CreatePostCommentsTable;
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
        $comments = $comment->post->get_comments_with_user($post->id);
        return $comments;
    }

    public function destroy(int $post_id, int $comment_id)
    {
        $comment = PostComment::where('id', $comment_id)->first();
        $comment->delete();
        $comments = $comment->post->get_comments_with_user($post_id);
        
        return $comments;
    }
}
