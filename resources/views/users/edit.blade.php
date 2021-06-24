@extends('layouts.app')

@section('title', 'ユーザー情報編集')

@section('content')
    @include('layouts.nav')
    <div class="container">
      <form method="POST" action="{{ route('users.update', ['name' => $user->name] )}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group mt-3">
          <input type="text" id="form1" class="form-control" name= "name" value="{{ old('name') ?? $user->name }}">
          <label class="form-label" for="form1">ユーザー名</label>
          <textarea name="description" id="form3" rows="5" class="form-control" placeholder="プロフィールを充実させよう">{{ old('description') ?? $user->description ?? ''}}</textarea>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFileLang" name="profile_image">
          <label class="custom-file-label" for="customFileLang">ユーザー画像選択</label>
        </div>

        <a href="{{ route('users.show', ['name' => $user->name] )}}">戻る</a>
        <button type="submit" class="btn ripe-malinka-gradient" style="color: aliceblue">更新する</button>
      </form>
    </div>
@endsection