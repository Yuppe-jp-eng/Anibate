<?php

namespace App\Http\Controllers\Work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkRequest;
use App\User;
use App\WatchedAnime;
class WorkController extends Controller
{
    public function search()
    {
        $token = config('services.annict_token');
        return view('works.index', ['token' => $token]);
    }

    public function show(Request $request)
    {
        $token = config('services.annict_token');
        $work_id = $request->query('id');
        return view('works.show', [
            'work_id' => $work_id,
            'token' => $token,
        ]);
    }

    public function create(Request $request)
    {
        $title = $request->query('title');
        $season = $request->query('season');

        return view('works.create',[
            'title' => $title,
            'season' => $season,
        ]);
    }

    public function store(WorkRequest $request, WatchedAnime $anime)
    {
        $anime->fill($request->all());
        $anime->season = $request->input('year') . '年' . $request->input('season');
        $anime->save();
        $user = User::where('id', $anime->user_id)->first();
        return redirect()->route('users.show', ['name' => $user->name]);
    }
}
