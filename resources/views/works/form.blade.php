@csrf
<div class="form-group">
  <div class="p-2 form-outline mt-3">
    <div>
      <h4>{{ $title }}<br>{{$season}}</h4>
      <label for="wathed_year" class="form-label">視聴完了時期</label><br>
      <input type="text"  name="year" id="watched_year" placeholder="例:2015" value="{{ old('year') }}">年
      <select name="season" id="season">
        <option value="春">春</option>
        <option value="夏">夏</option>
        <option value="秋">秋</option>
        <option value="冬">冬</option>
      </select>
      <input type="hidden" name="user_id" value="{{ Auth::id() }}">
      <input type="hidden" name="broadcast_season" value="{{ $season }}">
      <input type="hidden" name="title" value="{{ $title }}">
    </div>

  </div>
  <label></label>
  <textarea name="memo" required rows="5" placeholder="メモ" class="form-control" >{{ old('memo') ?? ''}}</textarea>
</div>