@extends('app')

@section('title', '投稿一覧')
    
@section('content')
@include('layouts.nav')

<div class="container mt-3">

  <h5>{{ $title }}の感想一覧</h5>
@foreach ($posts as $post)
  @include('layouts.card_list')
@endforeach
</div>
<div class="pagination mt-4">
  {{ $posts->links('vendor.pagination.simple-bootstrap-4')}}
</div>
</div>
@endsection