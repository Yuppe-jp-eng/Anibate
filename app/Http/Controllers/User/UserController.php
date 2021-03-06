<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use App\WatchedAnime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Pagination\Paginator;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('posts.user', 'posts.postComments');

        $all_posts = $user->posts->sortByDesc('created_at')->paginate(5);
        $favorite_posts = $user->likes()
        ->withPivot('created_at AS favorited_at')
        ->orderBy('favorited_at', 'desc')->paginate(5);

        return view('users.show', compact('user', 'all_posts', 'favorite_posts'));
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

    #年代とシーズンから視聴登録済み作品を検索し、作品情報を配列でVue側へ返す
    public function search_my_works(Request $request):array
    {
        $season = $request->query('year') . '年' . $request->query('season');
        $works = WatchedAnime::where('season', $season)
        ->where('user_id', Auth::id())
        ->orderByDesc('created_at')
        ->get()
        ->toArray();
        return $works;
    }

    #登録アニメの削除
    public function delete_anime(int $watched_anime_id):array
    {
        $watched_anime = WatchedAnime::find($watched_anime_id);
        $season = $watched_anime->season;
        $watched_anime->delete();

        $works = WatchedAnime::where('season', $season)
        ->where('user_id', Auth::id())
        ->get()->toArray();
        return $works;
    }
}
