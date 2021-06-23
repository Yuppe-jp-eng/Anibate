<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
class FollowController extends Controller
{
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();
        $followers = $user->followers->sortByDesc('created_at');
        
        return view('users.followers',[
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first();
        $followings = $user->followings->sortByDesc('created_at');
        
        return view('users.followings',[
            'user' => $user,
            'followings' => $followings,
        ]);
    }
}