@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-sm-offset-2 col-sm-8">
    <!-- Following -->
    <div class="panel panel-default">

      <!--<div class="panel-heading">All Users</div>-->
      <div class="panel-body">
        <table class="table table-striped task-table">
          <thead>
            <th>ユーザー</th>
            <th> </th>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td clphpass="table-text"><div>{{ $user->name }}</div></td>
              @if (auth()->user()->isFollowing($user->id))
              <td>
                <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" id="delete-follow-{{ $user->id }}" class="btn btn-danger"><i class="fa fa-btn fa-trash"></i>フォローを外す</button>
                </form>
              </td>
              @else
              <td>
                <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                  {{ csrf_field() }}
                  <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success"><i class="fa fa-btn fa-user"></i>フォローする</button>
                </form>
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <a class="btn btn-primary" href="{{ route('top') }}">他の投稿を見る</a>
      <a class="btn btn-primary" href="{{ route('posts.create') }}"><i class="fas fa-pen-square"></i>投稿をする</a>
    </div>
  </div>
</div>
@endsection
