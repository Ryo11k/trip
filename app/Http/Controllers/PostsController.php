<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Auth;

class PostsController extends Controller
{
  public function index() {
    // DBよりPostテーブルの投稿を作成日時の降順を取得
    $posts=Post::orderBy('created_at','desc')->paginate(10);
    
    // 取得した値をビュー「posts/index」に渡す,
    //compact('posts')は['posts'=>$posts]と同じ,view関数は第一引数にビューの名前、第二引数にビューに渡したい値
    return view('posts.index',compact('posts'));
  }

  public function create() {
    return view('posts.create');
  }

  public function store(Request $request) {
    $request->validate([
      'title'=>'required|max:50',
      'body'=>'required|max:2000',
    ]);

    DB::beginTransaction();
    try{
      $post = new Post;
      $post->title = $request->title;
      $post->body = $request->body;
      if($request->hasFile('file')) {
        $post->photo = date('YmdHis').$request->file('file')->getClientOriginalName();//画像ファイルのファイル名
        $request->file('file')->storeAs('test', $post->photo);
      }
      $post->save();
      DB::commit();
      return redirect()->route('top');
    }catch (\PDOException $e){
      DB::rollBack();
      return view('posts.create');
    }
    // dd($request->file('file')->getClientOriginalName());
  }

  public function show($post_id) {
    $post = Post::findOrFail($post_id);
    $like = $post->likes()->where('user_id', Auth::user()->id)->first();
    return view('posts.show')->with(array('post' => $post, 'like' => $like));
  }

  public function edit($post_id) {
    $post = Post::findOrFail($post_id);
    return view('posts.edit', compact('post'));
  }

  public function update($post_id, Request $request) {
    $params = $request->validate([
      'title' => 'required|max:50',
      'body' => 'required|max:2000',
    ]);
    $post = Post::findOrFail($post_id);
    $post->fill($params)->save();
    return redirect()->route('posts.show', compact('post'));
  }

  public function destroy($post_id) {
    $post = Post::findOrFail($post_id);
    \DB::transaction(function () use ($post) {
      $post->comments()->delete();
      $post->delete();
    });
    return redirect()->route('top');
  }
}
