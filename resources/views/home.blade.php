@extends('layout')

@section('content')

<div class="container-fluid">
  <div class="row">
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
                {{ optional($post->user)->name }}
              </a>
            </h5>
            <!-- 投稿内容がここに表示されます。 -->
            <p class="card-text">{{ $post->content }}</p>
            <img src="{{ asset('/storage/'.$post->post_img) }}">
            <!-- コメントが表示されます -->
            <ul class="list-group">

            </ul>
            <!-- 投稿時刻 -->
            <span class="post-time">{{ $post->created_at }}</span>
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