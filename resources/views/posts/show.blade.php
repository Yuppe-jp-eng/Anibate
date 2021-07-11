@extends('layouts.app')

@section('title', 'コメント投稿画面')

@section('css')
<style>
  .comment_link{
    display:none!important;
  }
</style>

@endsection
@section('content')

@include('layouts.nav')
    <div class="container">
      @include('layouts.card_list')
      <post-comment
      :comments='@json($comments)'
      :auth-id='@json(Auth::id())'
      endpoint='{{ route('post_comment', ['post' => $post] )}}'
      >
      </post-comment>
    </div>
@endsection

