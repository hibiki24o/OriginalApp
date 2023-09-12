@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">投稿編集</div>
        <div class="card-body">
          <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="content">投稿内容</label>
              <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required>{{ $post->content }}</textarea>
              <img src="{{ asset('/storage/'.$post->post_img) }}" class="post_img">
              @error('content')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <style>
              .post_img {
                width: 600px;
                height: 400px;
              }
            </style>

            <div class="form-group">
              <label for="post_img">画像を編集する場合は選択してください:</label>
              <input type="file" name="post_img" accept="image/*" class="form-control-file" id="post_img">
            </div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary">
                更新する
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection