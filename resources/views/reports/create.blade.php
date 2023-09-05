@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">違反報告</div>
        <div class="card-body">
          <form method="POST" action="{{ route('report.store') }}">
            <input type="hidden" name="post_id" value="{{ $post['id'] }}">
            @csrf
            <div class="form-group">
              <label for="content">違反内容</label>
              <textarea id="report_text" class="form-control @error('content') is-invalid @enderror" name="report_text" required>{{ old('content') }}</textarea>
              @error('content')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary">
                報告する
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection