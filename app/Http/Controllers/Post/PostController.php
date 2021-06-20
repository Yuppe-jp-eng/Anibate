<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
    
    public function create(?Request $request)
    {
        $title = $request->query('title');
        $episode = $request->query('episode');

        return view('posts.create', [
            'title' => $title,
            'episode' => $episode
            ]);
    }

    public function store(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect()->route('top');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(PostRequest $request, Post $post)
    {
        if ($request->comments_allowed == null)
        {
            $post->comments_allowed = "true";
        }else
        {
            $post->comments_allowed = "false";
        }
        $post->fill($request->all())->save();
        return redirect()->route('top');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('top');
    }
}
