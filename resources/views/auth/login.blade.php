@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">ログイン</div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
              <label for="email">メールアドレス</label>
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password">パスワード</label>
              <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">ログイン</button>
              <a href="{{ route('register') }}" class="btn btn-link">新規登録</a>
              <a href="{{ route('password.request') }}">パスワードの変更はこちらから</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection