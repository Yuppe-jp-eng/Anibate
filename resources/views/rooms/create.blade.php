@extends('app')

@section('content')
@include('layouts.nav')
  <div class="container">

    <div class="card mt-3">
      <div class="card-body">
        @include('errors.error_card')
        <form method="POST" action="{{ route('rooms.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group mt-3">
            <label class="form-label" for="form1">ルーム名</label>
            <input type="text" id="form1" class="form-control" name= "name" placeholder="ルーム名">
            
          </div>
          <div class="mt-1 d-flex justify-content-between">
            <div><button type="submit" class="btn btn-sm ripe-malinka-gradient ml-auto" style="color: aliceblue">更新する</button></div>
          </div>
  
        </form>
      </div>
  </div>


  </div>
@endsection