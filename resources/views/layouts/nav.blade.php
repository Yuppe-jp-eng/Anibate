  <nav class="navbar navbar-expand navbar-dark ripe-malinka-gradient">

    <a class="navbar-brand" href="/" style="margin-right: 0"><i class="fas fa-child"></i>Anibate</a>
  
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('top') }}">感想</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('search')}}">アニメ検索</a>
      </li>
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login')}}">ログイン</a>
      </li>
      @endguest
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('rooms.index')}}">ルーム</a>
      </li>
      @endauth
      @auth
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <button class="dropdown-item" type="button"
                  onclick="location.href='{{ route('users.show', ['name' => Auth::user()->name]) }}'">
            マイページ
          </button>
          <div class="dropdown-divider"></div>
          <button form="logout-button" class="dropdown-item" type="submit">
            ログアウト
          </button>
        </div>
      </li>
      <form id="logout-button" method="POST" action="{{ route('logout')}}">
        @csrf
      </form>
      <!-- Dropdown -->
      @endauth
    </ul>
  
  </nav>