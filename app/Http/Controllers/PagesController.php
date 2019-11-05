<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
      return view('pages.index');
    }

    public function create() {
      return view('pages.create');
    }

    /*public function show() {
      $post = Post::findOrFail($post_id);
      $like = $post->likes()->where('user_id', Auth::user()->id)->first();
      return view('pages.show')->with(array('post' => $post, 'like' => $like));
    }*/
}
