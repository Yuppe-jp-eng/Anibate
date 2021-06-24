@extends('layouts.app')

@section('title', 'ユーザー詳細')

@section('content')
  @include('layouts.nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <div class="d-flex flex-row">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark" style="display: inline">
            <img src="{{ $user->profile_image }}" alt="画像" width="60px" height="60px" style="border-radius: 50%" class="user-image">
          </a>
          <p class="ml-3">{{ $user->description }}</p>
          <a href="{{ route('users.edit', ['name' => $user->name] )}}" class="ml-auto"><i class="fas fa-user-edit fa-x red-text"></i></a>
          @if ($user->id !== Auth::id())
              <follow-button
              class="ml-auto"
              :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
              :authorized='@json(Auth::check())'
              endpoint="{{ route('users.follow', ['name' => $user->name])}}">
              </follow-button>
          @endif
        </div>
        <h2 class="h5 card-title m-0">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            {{ $user->name }}
          </a>
        </h2>
      </div>
      <div class="card-body">
        <div class="card-text" style="display: flex;align-items:center">
          <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
            {{ $user->count_followings }}フォロー
          </a>
          <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
            {{ $user->count_followers }}フォロワー
          </a>
          @if ($user == Auth::user())
          <a href="#" class="btn btn-danger ml-auto">myアニメ</a>
          @endif

        </div>
      </div>
    </div>
  </div>
@endsection