<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User {
  use Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
  * The attributes that should be cast to native types.
  *
  * @var array
  */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function likes() {
    return $this->hasMany(Like::class);
  }

  public function followers() {
    return $this->belongsToMany(self::class, 'follows', 'follows_id', 'user_id')->withTimestamps();
  }

  public function follows() {
    return $this->belongsToMany(self::class, 'follows', 'user_id', 'follows_id')->withTimestamps();
  }

  public function follow($userId) {
    $this->follows()->attach($userId);
    return $this;
  }

  public function unfollow($userId) {
    $this->follows()->detach($userId);
    return $this;
  }

  public function isFollowing($userId) {
    return (boolean) $this->follows()->where('follows_id', $userId)->first();
  }
}
