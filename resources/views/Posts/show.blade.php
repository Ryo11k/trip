@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border">
    <h3 class="h5">タイトル</h3>
    <h1 class="h5">{{ $post->title }}</h1>
    <h3 class="h5">本文</h3>
    <h1 class="h5">{{ $post->body }}</h1>

    <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
      @csrf
      <input name="post_id" type="hidden" value="{{ $post->id }}">
      <div class="form-group">
        <label for="body"><i class="far fa-comment"></i>コメント</label>
        <textarea id="body" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="4">{{ old('body') }}</textarea>
        @if ($errors->has('body'))
        <div class="invalid-feedback">{{ $errors->first('body') }}</div>
        @endif
      </div>

      <!--<div class="mb-4 text-right">
        <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">編集する</a>
        <form style="display: inline-block;" method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
          @csrf
          @method('DELETE')<button class="btn btn-danger">削除する</button>
        </form>
      </div>-->

      <div class="mt-4">
        <button type="submit" class="btn btn-primary"><i class="far fa-comment"></i>コメントする</button>
        <a class="btn btn-primary" href="{{ route('top') }}">投稿を見る</a>
      </div>
    </form>

    <section>
      <h2 class="h5"><i class="far fa-comment"></i>コメント</h2>
      @forelse($post->comments as $comment)
      <div class="border-top">
        <time class="text-secondary">{{ $comment->created_at->format('Y.m.d H:i') }}</time>
        <p class="mt-2">{!! nl2br(e($comment->body)) !!}</p>
      </div>
      @empty
      <p>コメントはまだありません</p>
      @endforelse
    </section>

    @if (Auth::check())
    @if ($like)
    {{ Form::model($post, array('action' => array('LikesController@destroy2', $post->id, $like->id))) }}
    <button type="submit">
      <i class="far fa-thumbs-up"></i>
      Like {{ $post->likes_count }}
    </button>
    {!! Form::close() !!}
    @else
    {{ Form::model($post, array('action' => array('LikesController@store2', $post->id))) }}
    <button type="submit">
      <i class="far fa-thumbs-up"></i>
      Like {{ $post->likes_count }}
    </button>
    {!! Form::close() !!}
    @endif
    @endif
  </div>
</div>
@endsection
