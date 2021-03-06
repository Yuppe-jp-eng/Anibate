@csrf
<div class="form-outline mt-3">
  <div class="mb-3" style="text-align: right">
    <a href="{{ route('search')}}">アニメ検索</a>
  </div>
  <label class="form-label" for="form1">アニメタイトル</label>
  <input type="text" id="form1" class="form-control" name= "title" value="{{ $title ?? old('title') ?? $post->title ?? '' }}"/>
  <label class="form-label mt-3" for="form2">エピソード</label>
  <input type="text" id="form2" class="form-control" name = "episode" value="{{ $episode ?? old('episode') ?? $post->episode ?? '' }}"/>

</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required rows="10" placeholder="アニメの感想を綴ってね" class="form-control" >{{ old('body') ?? $post->body ?? ''}}</textarea>
</div>

@if ($post->comments_allowed ?? true)
<div class="custom-control custom-checkbox mb-3">
  <input type="checkbox" class="custom-control-input" id="defaultChecked2" name="comments_allowed" value="{{ old('comments_allowed') ?? "false"}}">
  <label class="custom-control-label" for="defaultChecked2">コメント投稿拒否</label>
</div>
@else
<div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input" id="defaultChecked2" name="comments_allowed2" value="{{ old('comments_allowed') ?? $post->comments_allowed ?? "false"}}" checked>
  <label class="custom-control-label" for="defaultChecked2">コメント投稿拒否</label>
</div>
@endif