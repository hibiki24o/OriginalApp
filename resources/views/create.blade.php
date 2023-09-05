@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">投稿作成</div>
        <div class="card-body">
          <form method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="content">投稿内容</label>
              <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required>{{ old('content') }}</textarea>
              @error('content')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="post_image">画像のアップロード</label>
              <input type="file" class="form-control-file" id="post_image" name="post_image">
              @error('post_image')
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