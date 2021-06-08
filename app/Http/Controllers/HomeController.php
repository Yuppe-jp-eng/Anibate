<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function top()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return view('top', ['posts' => $posts]);
    }
}
