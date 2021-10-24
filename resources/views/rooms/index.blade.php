@extends('app')

@section('content')
    @include('layouts.nav')
    <div class="container mt-5">
      <div class="card mt-3">
        <div class="card-body">
          <div>
            <div class="mr-3 d-flex flex-row">
              <h4>参加中ルーム</h4>
              <a href="{{ route('rooms.create')}}" class="ml-auto"><i class="fas fa-user-friends red-text fa-x"></i>+</a>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                @foreach ($rooms as $room)
                <li class="list-group-item">{{ $room->name }} <span>（{{ $room->users->count() }}）</span></li>
                @endforeach

              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
@endsection