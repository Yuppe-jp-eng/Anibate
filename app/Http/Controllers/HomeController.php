<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function top()
    {
        $posts = Post::all()->sortByDesc('created_at')
        ->load('user', 'likes', 'post_comments')->paginate(8);
        return view('top', compact('posts'));
    }
}
