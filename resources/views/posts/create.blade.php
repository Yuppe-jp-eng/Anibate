@extends('app')

@section('title', '感想投稿')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card mt-3">
        <div class="card-body pt-0">
          @include('errors.error_card')
          <div class="card-text">
            <form method="POST" action="{{ route('posts.store') }}">
              @include('posts.form')
              <button type="submit" class="btn ripe-malinka-gradient btn-block" style="color: aliceblue">投稿する</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection