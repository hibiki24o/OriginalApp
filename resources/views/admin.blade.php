<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Original App - @yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            <!-- ログアウトボタン -->
            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </div>
        @endif
      </div>
    </nav>
  </header>

  <div class="container">
    <h2>@yield('title')</h2>
    <div class="row">
      <div class="col-md-6">
        <h3>ユーザーリスト</h3>
        @foreach($topDisabledUsers as $user)
        <div class="card mb-4">
          <div class="card-body">
            <!-- ユーザー名 -->
            <h5 class="card-title">
              {{ $user->name }}
            </h5>
            <!-- 表示停止された投稿件数 -->
            <p class="card-text">表示停止された投稿件数: {{ $user->disabled_count }}</p>
          </div>
        </div>
        @endforeach
      </div>



      <div class="col-md-6">
        <h3>違反報告リスト</h3>
        <!-- 違反報告リストを表示する部分 -->
        <ul class="list-group">
          @foreach($topReportedPosts as $post)
          <a href="{{ route('admin.edit', ['id' => $post->id]) }}">
            <li class="list-group-item">{{ $post->content }}</li>
          </a>
          <!-- 違反報告を受けた件数 -->
          <p class="card-text">違反報告を受けた件数: {{ $post->report_count }}</p>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <footer>
    <!-- フッターのコンテンツをここに配置 -->
  </footer>
</body>

</html>