@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">マイページ</div>
        <div class="card-body">
          <!-- アイコンを登録・変更する -->
          <a class="nav-link" href="{{ route('mypage.edit', ['post' => Auth::user()->id]) }}">
            @if (Auth::user()->icon_img)
            <img src="{{ asset('storage/' . Auth::user()->icon_img) }}" alt="ユーザーアイコン" class="icon">
            @endif
          </a>
          <style>
            /* アイコン画像のスタイル */
            .icon {
              width: 300px;
              height: 300px;
            }
          </style>

          @csrf
          <form action="{{ route('user.updateIcon') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="icon">アイコン画像を選択してください:</label>
              <input type="file" name="icon_img" accept="image/*" class="form-control-file" id="icon_img">
            </div>
            <button type="submit" class="btn btn-primary">アイコンを変更</button>
          </form>

          <!-- 退会する（削除機能） -->
          <h4 class="mt-4">退会する場合は下記をクリックしてください</h4>
          <p>アカウントを削除すると再登録が必要です</p>
          <form action="{{ route('user.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">アカウントを削除</button>
          </form>
          <h4>投稿一覧</h4>
          <ul class="list-group">

            @foreach ($posts as $post)

            <li class="list-group-item">
              {{ $post->content }}
              <div class="float-right">
                @if (Auth::check() && Auth::user()->id === $post->user_id)
                <img src="{{ asset('/storage/'.$post->post_img) }}">
                <a href="{{ route('posts.update', ['post' => $post->id]) }}" class="btn btn-sm btn-primary">編集</a>
                <form action="{{ route('mypage.delete', ['post' => $post->id]) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">削除</button>
                </form>
                @else
                <button class="btn btn-sm btn-info">違反報告</button>
                <button class="btn btn-sm btn-secondary">コメント</button>
                @endif
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection