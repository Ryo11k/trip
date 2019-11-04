@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border">
    <h1 class="h5">投稿の新規作成</h1>

    <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}">
      @csrf
      <fieldset class="mb-4">
        <div class="form-group">
          <label for="title">タイトル</label>
          <input id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}" type="text">
          @if($errors->has('title'))
          <div class="invalid-feedback">{{ $errors->first('title' )}}</div>
          @endif
        </div>

        <div class="form-group">
          <label for="body">本文</label>
          <textarea id="body" name="body" class="form-control{{ $errors->has('body')? 'is-invalid' : '' }}" row="4">{{ old('body') }}</textarea>
          @if($errors->has('body'))
          <div class="invalid-feedback">{{ $errors->first('body') }}</div>
          @endif
        </div>

          <input type="file" id="file" name="file" class="form-control" multiple>

        <div class="mt-5">
          <a class="btn-secondary" href="{{ route('top') }}">キャンセル</a>
          <button type="submit" class="btn btn-primary"><i class="fas fa-pen-square"></i>投稿する</button>
          <a class="btn btn-primary2" href="{{ route('top') }}">他の投稿を見る</a>
        </div>
      </fieldset>
    </form>
  </div>
</div>
@endsection
