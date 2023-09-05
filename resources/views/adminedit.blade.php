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
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            この投稿を非表示登録にしますか？
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.updateDelFlag', ['id' => $report->id]) }}">
              <h5 class="card-title">違反報告内容: {{ $post ? $post->content : '投稿が見つかりません' }}</h5>
              <h5 class="card-title">ユーザー名: {{ $user->name }}</h5>
              <p class="card-text">投稿内容: {{ $post->content }} </p>
              @if ($post->post_img)
              <p class="card-text">投稿画像:</p>
              <img src="{{ asset('storage/' . $post->post_img) }}" alt="投稿画像" class="img-fluid">
              @endif
              <p class="card-text">投稿日時: {{ $post->created_at }}</p>
              @csrf
              <button class="btn btn-sm btn-info" name='del_flg' value="1">非表示にする</button>
          </div>
        </div>