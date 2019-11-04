@extends('layouts.app')

@section('content')
<div class="top-wrapper">
  <div class="container">
    <h1>TripPost</h1>
    <p>旅好きな人と繋がろう</p>
    <div class="wrapper">
      <ul>
        <li><a class="btn btn-primary" href="{{ route('posts.create') }}"><i class="fas fa-pen-square"></i>投稿する</a></li>
        <li><a class="btn btn-primary" href="{{ route('top') }}"><i class="far fa-list-alt"></i>投稿一覧</a></li>
        <li><a class="btn btn-primary" href="{{ route('users') }}"><i class="fas fa-search"></i>フォローする</a></li>
        <li><a class="btn btn-primary" href="{{ route('pages.create') }}"><i class="fas fa-user-circle"></i>プロフィール</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection
