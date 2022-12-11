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
Route::post('post/create','PostsController@create');//投稿を押したとき データを作成しデータベースに保存する　同じURLのルーティングが2つあると下のURLが読み込まれる
Route::get('post/{id}/delete', 'PostsController@delete');//11/13追加（削除機能）
Route::get('/profile','UsersController@profile');

//ユーザー検索
Route::get('/search','UsersController@search');//検索欄に入力した文字を含むログインユーザー以外のユーザーを全員表示する
Route::post('users/searching','UsersController@searching');//ユーザー検索の結果一覧を表示する


Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

//ログアウト
Route::get('/logout','Auth\LoginController@logout');
