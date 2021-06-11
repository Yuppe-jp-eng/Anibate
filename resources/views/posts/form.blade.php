@csrf
<div class="form-outline mt-3">
  <input type="text" id="form1" class="form-control" name= "title" value="{{ $title ?? old('title') ?? $post->title ?? '' }}"/>
  <label class="form-label" for="form1">アニメタイトル</label>
  <input type="text" id="form2" class="form-control" name = "episode" value="{{ $title ?? old('episode') ?? $post->episode ?? '' }}"/>
  <label class="form-label" for="form2">話数</label>
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required rows="10" placeholder="アニメの感想を綴ってね" class="form-control" >{{ old('body') ?? $post->body ?? ''}}</textarea>
</div>
<div class="form-check mb-3">
  <input
    class="form-check-input"
    type="checkbox"
    name="comments_allowed"
    value="false"
    id="flexCheckDefault"
  />
  <label class="form-check-label" for="flexCheckDefault">
    コメント投稿拒否
  </label>
</div>