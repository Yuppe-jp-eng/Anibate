<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Http\Controllers\Controller;
use App\PostComment;
use App\User;
use ArrayObject;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function anime_index(string $title)
    {
        $posts = Post::where('title', $title)->get()
        ->sortByDesc('created_at')->paginate(8);

        return view('posts.anime_index', compact('title', 'posts'));

    }
    public function show(Post $post)
    {
        $comments = $post->get_comments_with_user($post->id);

        return view('posts.show',compact('post', 'comments'));
    }
    public function create(?Request $request)
    {
        $title = $request->query('title');
        $episode = $request->query('episode');

        return view('posts.create', compact('title', 'episode'));
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
