@extends('layout')

@section('title', '投稿詳細')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header">
          投稿詳細
        </div>
        <div class="card-body">
          <h5 class="card-title">ユーザー名:{{ $user->name }} </h5>
          <p class="card-text">投稿内容: {{ $post->content }}</p>
          @if ($post->post_img)
          <img src="{{ asset('storage/' . $post->post_img) }}" alt="投稿画像" class="img-fluid">
          @endif
          <p class="card-text">投稿時: {{ $post->created_at }}</p>
          <a href="{{ route('report.create',['post' => $post->id]) }}" class="btn btn-sm btn-info">違反報告</a>
          <a href="{{ route('posts.comment', ['post' => $post->id]) }}" class="btn btn-sm btn-secondary">コメント</a>
        </div>
        <!-- コメント一覧 -->
        <div class="row">
          <div class="col-md-8 offset-md-2 mt-3">
            <div class="card">
              <div class="card-header">
                コメント一覧
              </div>
              <div class="card-body">
                <ul class="list-group">
                  @foreach($comments as $comment)
                  <li class="list-group-item">{{ $comment->comment_text }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection