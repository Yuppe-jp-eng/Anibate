@extends('app')

@section('title', '感想更新')

@section('content')
@include('layouts.nav')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('errors.error_card')
            <div class="card-text">
              <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}">
                @method("PATCH")
                @include('posts.form')
                <button type="submit" class="btn btn-block ripe-malinka-gradient" style="color: aliceblue">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection