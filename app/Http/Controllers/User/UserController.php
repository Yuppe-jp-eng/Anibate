<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.show', [
            'user' => $user,
        ]);
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
        $user->fill($request->all());
        if ($request->profile_image !== null) {
            $userImg = $user->profile_image = $request->file('profile_image');
            $path = Storage::disk('s3')->putFile('/', $userImg, 'public');
            $user->profile_image = Storage::disk('s3')->url($path);
        }
        $user->save();
        return redirect()->route('users.show', ['name' => $user->name]);
    }

    public function likes()
    {

    }
}
