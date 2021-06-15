<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function like(Request $request, Post $post){
        $post->likes()->detach($request->user()->id); #いいねが重複しないように
        $post->likes()->attach(($request->user()->id));

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes, #vueで使う
        ];
    }
    public function unlike(Request $request, Post $post){
        $post->likes()->detach($request->user()->id);
        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes, #vueで使う
        ];
    }
}
