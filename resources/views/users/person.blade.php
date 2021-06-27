<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <div class="mr-3">
        <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark" style="display: inline">
          <img src="{{ $person->profile_image }}" alt="画像" width="60px" height="60px" style="border-radius: 50%" class="user-image">
        </a>
      </div>
      <h2 class="h5 card-title m-0">
        <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">
          {{ $person->name }}
        </a>
      </h2>
      @if ($person->id !== Auth::id())
          <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name])}}">
          </follow-button>
      @endif
      </div>
      <div class="card-body">
        <p class="ml-3">{{ $person->description }}</p>
      </div>
    </div>
  </div>