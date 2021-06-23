@extends('layouts.app')

@section('title', $user->name . 'のフォロー中')


@section('content')
  @include('layouts.nav')
  <div class="container">
    @include('users.user')
    @foreach ($followings as $person)
        @include('users.person')
    @endforeach
  </div>
@endsection