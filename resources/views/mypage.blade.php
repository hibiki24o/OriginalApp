@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">マイページ</div>
        <div class="card-body">
          <h4>投稿一覧</h4>
          <ul class="list-group">

            @foreach ($posts as $post)

            <li class="list-group-item">
              {{ $post->content }}
              <div class="float-right">
                @if (Auth::check() && Auth::user()->id === $post->user_id)
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