@extends('layouts.app')
@section('title', '作品詳細')
    
@section('content')
@include('layouts.nav')
<div class="container mt-5">
  <work-information
  :work-id='@json($work_id)'
  token={{ $token }}>
  </work-information>
</div>
@endsection
