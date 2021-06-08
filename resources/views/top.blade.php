@extends('app')

@section('title', 'Anibate')
    
@section('content')
    @include('nav')
    <div class="container mt-5" style="text-align: center">
      <h1>Anibate</h1>
      <p>Anibateはアニメをもっと身近に感じるためのプラットフォームです。</p>
      <p>
        いつどの作品を見ていたか記録できたり、アニメについて自分の感想を語ることができます。
      </p>
      <a href="{{ route('register') }}" class="btn btn-outline-danger btn-lg active" role="button" aria-pressed="true"
      >登録する</a>
    </div>
@endsection