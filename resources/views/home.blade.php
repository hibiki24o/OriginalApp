<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // 検索フォームの送信時に非同期で検索を実行
    $("#search-form").submit(function(event) {
      event.preventDefault();

      // 検索フォームからデータを取得
      var formData = $(this).serialize();

      // Ajaxリクエストを送信
      $.ajax({
        type: "GET",
        url: "{{ route('home') }}", // 検索処理を行うルートのURL
        data: formData, // 検索フォームのデータを送信
        success: function(response) {
          // 検索結果を表示するコードをここに追加
          console.log(response);
          // 検索結果を別の要素に表示
          $("#search-results").html(response);
        },
        error: function(error) {
          console.log(error);
        }
      });
    });
  });
</script>


@extends('layout')

@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 text-center">
      <h2>検索</h2>
      <form action="{{ route('home') }}" method="GET">
        @csrf
        <div class="form-group">
          <input type="text" class="form-control" name="keyword" placeholder="検索キーワード">
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="search_option" id="search_users" value="users">
          <label class="form-check-label" for="search_users">ユーザー名</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="search_option" id="search_text" value="text">
          <label class="form-check-label" for="search_text">テキスト</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="search_option" id="search_date" value="date">
          <label class="form-check-label" for="search_date">日付</label>
        </div>

        <div class="form-group">
          <input type="date" class="form-control" name="date" placeholder="日付">
        </div>
        <button type="submit" class="btn btn-primary">検索</button>
      </form>
    </div>
    @yield('content')
    <!-- 投稿一覧 (左側6) -->
    <div class="col-md-6">
      <h2>投稿一覧</h2>
      <div class="post-list">
        <!-- 各投稿を繰り返し表示する -->
        @foreach($posts as $post)
        <div class="card mb-3">
          <div class="card-body">

            <!-- 投稿者名 -->
            <h5 class="card-title">

              <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                @if ($post->user)
                {{ $post->user->name }}
                @else
                @endif
              </a>

            </h5>
            <!-- 投稿内容がここに表示されます。 -->
            @if ($post->content)
            <p class="card-text">{{ $post->content }}</p>
            @else
            @endif
            <img src="{{ asset('/storage/'.$post->post_img) }}">
            <!-- コメントが表示されます -->
            <ul class="list-group">

            </ul>
            <!-- 投稿時刻 -->
            @if ($post->created_at )
            <span class="post-time">{{ $post->created_at }}</span>
            @else
            @endif
          </div>
        </div>
        @endforeach
        <!-- 他の投稿も同様に繰り返す -->
      </div>
    </div>
    <!-- タイムライン一覧 (右側4) -->
    <div class="col-md-6">
      <div class="timeline-list">
        <h3>タイムライン</h3>
        <ul class="list-group">
          @foreach ($latestPosts as $latestPost)
          <li class="list-group-item">{{ $latestPost->content }}</li>
          @endforeach
          <!-- 他のタイムラインの内容も同様に追加 -->
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection