@extends('app')
@include('layouts.nav')
@section('content')
    <div class="container mt-5 d-flex flex-column">
      <h4>{{ $room->name }}</h4>
      <chat
       :chat-messages='@json($chats)'
       auth-id='{{ Auth::id() }}'
       room-id='{{ $room->id }}'>
      </chat>
    </div>
@endsection