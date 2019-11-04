@extends('layouts.app')

@section('content')
<h3>プロフィール</h3>
<table class="table table-striped">
  <tr>
    <th>名前</th>
    <td>{{ Auth::user()->name }}</td>
  </tr>
  <tr>
    <th>メールアドレス</th>
    <td>{{ Auth::user()->email }}</td>
  </tr>
</table>
@endsection
