@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="mb-4">
    <a href="{{ route('posts.create') }}" class="btn btn-primary">投稿を新規作成する</a>
    <a class="btn btn-primary" href="{{ route('pages.create') }}"><i class="fa fa-btn fa-user"></i>プロフィール</a>
  </div>

  @foreach ($posts as $post)
  <!--<div class="mb-4 text-right">
    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">編集する</a>
    <form style="display: inline-block;" method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
      @csrf
      @method('DELETE')<button class="btn btn-danger">削除する</button>
    </form>
  </div>-->
  <div class="card mb-4">
    <div class="card-header">{{ $post->title }}</div>
    <div class="card-body">
    <p class="card-text">{!! nl2br(e(str_limit($post->body, 200))) !!}</p>
    </div>

    <div class="card-footer">
      @if (Auth::check())
      @if ($post->like())
      {{ Form::model($post, array('action' => array('LikesController@destroy', $post->id, $post->like()))) }}
      <button type="submit">
        <i class="far fa-thumbs-up"></i>
        {{ $post->likes_count }}
      </button>
      {!! Form::close() !!}
      @else
      {{ Form::model($post, array('action' => array('LikesController@store', $post->id))) }}
      <button type="submit">
        <i class="far fa-thumbs-up"></i>
        {{ $post->likes_count }}
      </button>
      {!! Form::close() !!}
      @endif
      @endif

      <span class="mr-2">{{ $post->created_at->format('Y.m.d') }}</span>
      <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}"><i class="far fa-comment"></i></a>

      @if ($post->comments->count())
      <span class="badge badge-primary"><i class="far fa-comment"></i>コメント {{ $post->comments->count() }}件</span>
      @endif
    </div>
  </div>
  @endforeach

  <div class="d-flex justify-content-center mb-5">{{ $posts->links() }}</div>
</div>
@endsection
