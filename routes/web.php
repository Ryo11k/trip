<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::resource('users','UserController');
Route::resource('comments','CommentsController',['only'=>['store']]);
Route::resource('pages','PagesController',['only'=>['index','create']]);

/*Route::get('/','PagesController@index');
Route::get('profile','PagesController@profile');
Route::get('top', 'PostsController@index')->name('top');*/
Route::get('/', 'PagesController@index');
/*Route::get('create', 'PagesController@create');*/

Route::post('/posts/{post}/likes', 'LikesController@store');
Route::post('/posts/{post}/likes/{like}', 'LikesController@destroy');

Route::group(['middleware' => 'auth'], function () {
    Route::get('users', 'UserController@index')->name('users');
    Route::post('users/{user}/follow', 'UserController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UserController@unfollow')->name('unfollow');
    Route::resource('posts','PostsController',['only'=>['create','store','show','edit','update','destroy']]);
    Route::get('top', 'PostsController@index')->name('top');
    Route::resource('pages','PagesController',['only'=>['index','create']]);
});
