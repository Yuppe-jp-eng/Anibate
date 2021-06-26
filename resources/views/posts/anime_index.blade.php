@extends('layouts.app')

@section('title', '投稿一覧')
    
@section('content')
@include('layouts.nav')

<div class="container mt-3">

  <h3>{{ $title }}の感想一覧</h3>
  @include('layouts.card_list')
</div>

@endsection