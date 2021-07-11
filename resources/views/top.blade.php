@extends('app')

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
      @foreach ($posts as $post)
        @include('layouts.card_list')
      @endforeach
      <div class="pagination mt-4">
        {{ $posts->links('vendor.pagination.simple-bootstrap-4')}}
      </div>
    </div>

@endsection