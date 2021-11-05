@extends('app')

@section('title', 'ユーザー詳細')

@section('content')
  @include('layouts.nav')
  <div class="container">
    @include('users.user')
    <ul class="nav nav-tabs md-tabs nav-justified mt-3" role="tablist" >
      <li class="nav-item">
        <a class="nav-link text-muted active" data-toggle="tab" 
        href="#post" role="tab">
          感想
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-muted" data-toggle="tab" 
        href="#favorite" role="tab">
          いいね</a>
      </li>
      @if ($user->id == Auth::id())
      <li class="nav-item">
        <a class="nav-link text-muted" data-toggle="tab" 
        href="#myanime" role="tab">
          Myアニメ</a>
      </li>
      @endif

    </ul>
    <div class="tab-content">
      <div id="post" class="tab-pane active">
        @foreach ($all_posts as $post)
          @include('layouts.card_list')
        @endforeach
        <div class="pagination mt-4">
          {{ $all_posts->links('vendor.pagination.simple-bootstrap-4')}}
        </div>
      </div>
      <div id="favorite" class="tab-pane">
        @foreach ($favorite_posts as $post)
            @include('layouts.card_list')
        @endforeach
        <div class="pagination mt-4">
          {{ $favorite_posts->links('vendor.pagination.simple-bootstrap-4')}}
        </div>
      </div>
      <div id="myanime" class="tab-pane">
        <my-anime-search
        search_endpoint="{{ route('users.searches', ['name' => $user->name] )}}">
        </my-anime-search>
      </div>
    </div>


  </div>
@endsection