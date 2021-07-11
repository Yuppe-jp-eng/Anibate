@extends('layouts.app')

@section('title', '視聴済み登録画面')
    
@section('content')
    @include('layouts.nav')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card mt-3">
            <div class="card-body pt-0">
              @include('errors.error_card')
              <div class="card-text">
                <form method="POST" action="{{ route('works.store') }}">
                  @include('works.form')
                  <button type="submit" class="btn ripe-malinka-gradient btn-block" style="color: aliceblue">登録する</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection