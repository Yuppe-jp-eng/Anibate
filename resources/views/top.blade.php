@extends('layouts.app')

@section('title', 'Anibate')
    
@section('content')
    @include('layouts.nav')
    @guest
    <div class="container mt-5" style="text-align: center">
      <h1>Anibate</h1>
      <p>Anibateはアニメをもっと身近に感じるためのプラットフォームです。</p>
      <p>
        いつどの作品を見ていたか記録できたり、アニメについて自分の感想を語ることができます。
      </p>
      <a href="{{ route('register') }}" class="btn btn-outline-danger btn-lg active" role="button" aria-pressed="true"
      >登録する</a>
    </div>
    @endguest

    <div class="container">
      @foreach($posts as $post)
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          <i class="fas fa-user-circle fa-3x mr-1"></i>
          <div>
            <div class="font-weight-bold">
              {{ $post->user->name }}
            </div>
            <div class="font-weight-lighter">
              {{ $post->created_at->format('Y/m/d H:i') }}
            </div>
          </div>
        </div>
        <div class="card-body pt-0 pb-2">
            <h3 class="h4 card-title" style="display: inline-block">
              {{ $post->title }}
            </h3>
            <h3 class="h4 card-title" style="display: inline-block">
              {{ $post->episode }}
            </h3>
          <div class="card-text">
            {!! nl2br(e( $post->body )) !!}
          </div>
          <div style="text-align: right">
            @if ($post->comments_allowed)
            <a href="#">コメント</a>
            @endif
          </div>
        </div>
      </div>
    @endforeach
    </div>

@endsection