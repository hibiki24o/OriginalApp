home bladeのメイン部分

<main>
  <div class="container-fluid">
    <div class="row">
      <!-- 投稿一覧 (左側6) -->
      <div class="col-md-6">
        <div class="post-list">
          <!-- 各投稿を繰り返し表示する -->
          @foreach($posts as $post)
          <div class="post">
            <div class="post-header">
              <img src="{{ $post->user->profile_image }}" alt="User Icon" class="user-icon">
              <span class="username">{{ $post->user->name }}</span>
            </div>
            <div class="post-content">
              {{ $post->content }}
            </div>
            <div class="post-footer">
              <button class="comment-button">コメント</button>
              <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- タイムライン一覧 (右側4) -->
      <div class="col-md-4">
        <div class="timeline-list">
          <!-- タイムラインの内容を表示する -->
          <!-- タイムラインの表示方法についての指示が不足しているため、実装方法はアプリケーションの要件に合わせて調整してください -->
        </div>
      </div>
    </div>
  </div>
</main>