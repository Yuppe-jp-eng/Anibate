<?php

namespace App\Http\Controllers\Work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function create()
    {

    }

    public function store()
    {

    }
}
