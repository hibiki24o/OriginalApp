@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">コメント投稿</div>
        <div class="card-body">
          <form method="POST" action="{{ route('posts.comment', ['post' => $post_id]) }}">

            @csrf

            <div class="form-group">
              <label for="content">コメント内容</label>
              <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required>{{ old('content') }}</textarea>
              @error('content')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary">
                投稿する
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection