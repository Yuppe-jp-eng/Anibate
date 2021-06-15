@extends('layouts.app')

@section('title', 'Anibate')
    
@section('content')
    @include('layouts.nav')
    @guest
    <div class="container mt-5" style="text-align: center">
      <h1>Anibate</h1>
      <p>Anibateはアニメをもっと身近に感じるためのプラットフォームです。</p>
      <p>
        いつどの作品を見ていたか記録できたり、アニメについて自分の感想を語ることができます。
      </p>
      <a href="{{ route('register') }}" class="btn btn-outline-danger btn-lg active" role="button" aria-pressed="true"
      >登録する</a>
    </div>
    @endguest

    <div class="container">
      @foreach($posts as $post)
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          <i class="fas fa-user-circle fa-3x mr-1"></i>
          <div>
            <div class="font-weight-bold">
              {{ $post->user->name }}
            </div>
            <div class="font-weight-lighter">
              {{ $post->created_at->format('Y/m/d H:i') }}
            </div>
          </div>
          @if (Auth::id() == $post->user_id)
          <!-- dropdown -->
          <div class="ml-auto card-text">
            <div class="dropdown">
              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <button type="button" class="btn btn-link text-muted m-0 p-2">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route("posts.edit", ['post' => $post]) }}">
                  <i class="fas fa-pen mr-1"></i>更新する
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
                  <i class="fas fa-trash-alt mr-1"></i>削除する
                </a>
              </div>
            </div>
          </div>
          <!-- dropdown -->

          <!-- modal -->
          <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                    {{ $post->title }}{{ $post->episode }}の感想を削除します。よろしいですか？
                  </div>
                  <div class="modal-footer justify-content-between">
                    <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                    <button type="submit" class="btn btn-danger">削除する</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- modal -->
          @endif
        </div>
        <div class="card-body pt-0 pb-2">
            <h3 class="h4 card-title" style="display: inline-block">
              {{ $post->title }}
            </h3>
            <h3 class="h4 card-title" style="display: inline-block">
              {{ $post->episode }}
            </h3>
          <div class="card-text">
            {!! nl2br(e( $post->body )) !!}
          </div>
          <div class="card-body pt-0 pb-2 pl-3 row">
            <div class="card-text" style="display:inline-block">
              <post-like
              :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
              :initial-count-likes='@json($post->count_likes)'
              :authorized='@json(Auth::check())'
              endpoint='{{ route('favorites.like', ['post' => $post]) }}'>
              </post-like>
            </div>
            @if ($post->comments_allowed)
            <div class="ml-auto" style="display:inline-block" >
              <a href="#">コメント</a>
            </div>
            @endif
          </div>
        </div>
      </div>
    @endforeach
    </div>

@endsection