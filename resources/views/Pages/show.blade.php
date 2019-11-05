@extends(layouts.app)

@section('content')
<!--<div class="mb-4 text-right"> 
  <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">編集する</a>
  <form style="display: inline-block;" method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
    @csrf
    @method('DELETE')<button class="btn btn-danger">削除する</button>
  </form>
</div>
@endsection
