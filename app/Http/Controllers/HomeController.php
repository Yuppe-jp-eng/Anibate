<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function top()
    {
        if (Auth::id()) {
            $posts = Post::query()
            ->whereIn('user_id', Auth::user()->followings()->pluck('followee_id'))
            ->orWhere('user_id', Auth::id())
            ->latest()->get()->load('user', 'likes', 'post_comments')->paginate(8);
        } else {
            $posts = Post::all()->sortByDesc('created_at')
            ->load('user', 'likes', 'post_comments')->paginate(8);
        }

        return view('top', compact('posts'));
    }
}
