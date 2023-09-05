@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">検索</div>
        <div class="card-body">
          <form method="GET" action="{{ route('search') }}">
            <div class="form-group">
              <label for="username">ユーザーネーム検索</label>
              <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
            </div>

            <div class="form-group">
              <label for="content">文章内容検索</label>
              <input id="content" type="text" class="form-control" name="content" value="{{ old('content') }}">
            </div>

            <div class="form-group">
              <label for="start_date">開始日</label>
              <input id="start_date" type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
            </div>

            <div class="form-group">
              <label for="end_date">終了日</label>
              <input id="end_date" type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
            </div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary">
                検索する
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection