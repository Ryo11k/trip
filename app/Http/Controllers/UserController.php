<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Notifications\UserFollowed;

class UserController extends Controller
{
  public function index(){
    $users = User::where('id', '!=', auth()->user()->id)->get();
  return view('users.index',['users' => $users]);
  }

  public function create() {
    return view('users.create');
  }

  public function store(Request $request) {
    DB::beginTransaction();
    try {
      $user = new User;
      $user->title = $request->title;
      $user->body = $request->body;
      $user->save;
      DB::commit();
      return redirect('/users'.$user->id);
    } catch(\PDOException $e) {
      DB::rollback();
      return view('users.create');
    }
  }

  public function show(User $user) {
    return view('users.show', ['user' => $user]);
  }

  public function followUsers() {
    return $this->belongsToMany(self::class,'follow_users','user_id','followed_user_id')
    ->using(FollowUser::class);
  }

  public function follow(User $user) {
    $follower = auth()->user();
    if($follower->id == $user->id) {
      return back()->withError("You can't follow yourself");
    } if($follower->isFollowing($user->id)) {
      $follow->follow($user->id);
      return back()->withSuccess("You are now friends with {$user->name}");
        }
        return back()->withError("You are already following {$user->name}");
      }

  public function unfollow(User $user) {
    $follower = auth()->user();
    if($follower->isFollowing($user->id)) {
      $follower->unfollow($user->id);
      return back()->withSuccess("You are no longer friends with {$user->name}");
    }
    return back()->withError("You are not following {$user->name}");
  }

}
