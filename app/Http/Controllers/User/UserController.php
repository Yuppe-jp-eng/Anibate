<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        $all_posts = $user->posts->sortByDesc('created_at');
        $favorite_posts = $user->likes->sortByDesc('created_at');
        return view('users.show', [
            'user' => $user,
            'all_posts' => $all_posts,
            'favorite_posts' => $favorite_posts,
        ]);
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();
        if (Auth::id() !== $user->id) {
            return redirect()->route('users.show', ['name' => $name]);
        }
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();
        $user->fill($request->all());

        #名前変更なしだったら改めて元の名前を代入する
        if ($request->name == null) {
            $user->name = $name;
        }
        #S3へ画像をアップロードしてそのパスをprofile_imageカラムに保存
        if ($request->profile_image !== null) {
            $userImg = $user->profile_image = $request->file('profile_image');
            $path = Storage::disk('s3')->putFile('/', $userImg, 'public');
            $user->profile_image = Storage::disk('s3')->url($path);
        }
        $user->save();
        return redirect()->route('users.show', ['name' => $user->name]);
    }
}
