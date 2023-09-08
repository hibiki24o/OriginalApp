<!DOCTYPE html>
<html>

<head>

  <head>
    <title>Original App - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <!-- タイトル名でトップページへのリンク -->
        <a class="navbar-brand" href="{{ route('home') }}">Original App</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        @if(Auth::check())
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('mypage.edit', ['post' => Auth::user()->id]) }}">{{ Auth::user()->name }}</a>
              <!-- 投稿画面へのリンク -->
            <li class="nav-item">
              <a class="nav-link" href="{{ route('create') }}">投稿</a>
            </li>
            <!-- ログアウトボタン -->
            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>

            </li>
            @else

            @endif
          </ul>
        </div>
      </div>
    </nav>
  </header>
  @yield('content') <!-- 各ビューのコンテンツがここに挿入されます -->
  <footer>
    <!-- フッターのコンテンツをここに配置 -->
  </footer>
</body>
</head>

</html>