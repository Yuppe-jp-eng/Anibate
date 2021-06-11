<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $title = request('title');
        $episode = request('episode');

        return view('posts.create', [
            'title' => $title,
            'episode' => $episode
            ]);
    }

    public function store(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->user_id = $request->user()->id;
        // if ($request->comments_allowed) {
        //     $post->comments_allowed = $request->comments_allowed;
        // }
        $post->save();
        return redirect()->route('top');
    }
}
