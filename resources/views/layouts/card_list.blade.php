<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <a href="{{ route('users.show', ['name' => $post->user->name]) }}" class="text-dark" style="display: inline">
      <img src="{{ $post->user->profile_image }}" alt="画像" width="60px" height="60px" style="border-radius: 50%">
    </a>
    
    <div class="ml-3">
      <div class="font-weight-bold">
        <a href="{{ route('users.show', ['name' => $post->user->name])}}" class="text-dark">
        {{ $post->user->name }}
        </a>
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
      <a href="{{ route('title_index' , ['title' => $post->title])}}">
        <h3 class="h5 card-title mr-3" style="display: inline-block">
          {{ $post->title }}
        </h3>
      </a>

      <h3 class="h5 card-title" style="display: inline-block">
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
      <div class="ml-2 card-text comment_link" style="display:inline-block;" >
        <div>
          <button type="button" class="btn shadow-none m-0 p-1" style="padding: 0">
            <a href="{{ route('posts.show', ['post' => $post])}}"><i class="fas fa-comment"></i></a>
          </button>
              {{ $post->postComments->count() }}
        </div>
      </div>
      @endif
      @if (Auth::id() == $post->user_id)
      <div style="margin-left: auto">
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
        class= "twitter-share-button"
        data-show-count="false"
        data-text="{{ $post->user->name }}さんが「{{ $post->title }}」~{{$post->episode}}~の感想を投稿しました。" 
        data-url="http://anibate.com"
        data-hashtags="{{ $post->title }},anime"
        target="_blank">
      </a>
      </div>
      @endif

    </div>
  </div>
</div>