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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');
//Route::post('post/validator','PostsController@validator');//投稿を押したとき データを作成しデータベースに保存する　同じURLのルーティングが2つあると下のURLが読み込まれる
//Route::post('post/create','PostsController@create');
Route::post('post/creation','PostsController@creation');
//11/13追加（削除機能）
Route::get('post/{id}/delete', 'PostsController@delete');
//更新機能
Route::post('/post/update', 'PostsController@update');

//プロフィール編集
Route::get('/profile','UsersController@profile');
Route::post('users/update', 'UsersController@update');

//相手のプロフィール
Route::get('user/{id}/yourprofile','UsersController@yourprofile');



//ユーザー検索
Route::get('/search','UsersController@search');//検索欄に入力した文字を含むログインユーザー以外のユーザーを全員表示する
Route::post('users/searching','UsersController@searching');//ユーザー検索の結果一覧を表示する

//フォロー関連
Route::get('/follow-list','followsController@followList');
Route::post('follow/{follow}/follow','followsController@follow')->name('search.follow');
Route::delete('follow/{follow}/unfollow','followsController@unfollow')->name('search.unfollow');
Route::get('/follower-list','followsController@followerList');

//フォロー数カウント
//Route::get('/followCounts','followsController@followCounts');
//フォロー数カウント(5/9)
Route::get('follows/show','followsController@show');

//ログアウト
Route::get('/logout','Auth\LoginController@logout');
