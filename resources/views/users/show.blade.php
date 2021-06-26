@extends('layouts.app')

@section('title', 'ユーザー詳細')

@section('content')
  @include('layouts.nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <div class="d-flex flex-row">
          <div class="mr-3">
            <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark" style="display: inline">
              <img src="{{ $user->profile_image }}" alt="画像" width="60px" height="60px" style="border-radius: 50%" class="user-image">
            </a>
          </div>
          <div>
            <h5>{{ $user->name }}</h5>
            <p class="ml-3 pr-5">{{ $user->description }}</p>
          </div>
          @auth
          @if ($user->id == Auth::id())
          <a href="{{ route('users.edit', ['name' => $user->name] )}}" class="ml-auto"><i class="fas fa-user-edit fa-x red-text"></i></a>
          @endif
          @endauth
          @if ($user->id !== Auth::id())
              <follow-button
              class="ml-auto"
              :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
              :authorized='@json(Auth::check())'
              endpoint="{{ route('users.follow', ['name' => $user->name])}}">
              </follow-button>
          @endif
        </div>
      </div>
      <div class="card-body">
        <div class="card-text" style="display: flex;align-items:center">
          <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
            {{ $user->count_followings }}フォロー
          </a>
          <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
            {{ $user->count_followers }}フォロワー
          </a>
          @auth
          <a href="#" class="btn btn-danger ml-auto">myアニメ</a>
          @endauth
        </div>
      </div>
    </div>
  </div>
@endsection