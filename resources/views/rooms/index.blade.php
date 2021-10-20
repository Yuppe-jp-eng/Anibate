@extends('app')

@section('content')
    @include('layouts.nav')
    <div class="container mt-5">
      <div class="sab-header">
        <h3>参加中ルーム</h3>
        <a href="{{ route('rooms.create')}}">ルーム作成</a>
      </div>
      {{-- ルーム一覧コンポーネント化したい --}}
    </div>
@endsection