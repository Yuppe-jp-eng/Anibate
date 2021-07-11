@extends('app')

@section('title', 'アニメ検索')
    
@section('content',)
@include('layouts.nav')
<div class="container mt-4">
  <search
  token={{ $token }}>
  </search>
</div>
</div>
@endsection