<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.show', [
            'user' => $user,
        ]);
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function likes()
    {

    }
}
