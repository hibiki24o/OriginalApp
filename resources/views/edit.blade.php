@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">投稿編集</div>
        <div class="card-body">
          <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
            @csrf


            <div class="form-group">
              <label for="content">投稿内容</label>
              <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required>{{ $post->content }}</textarea>
              @error('content')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
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