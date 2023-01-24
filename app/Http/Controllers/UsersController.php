<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile')->with('user', Auth::user());
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->password = $request->input('password');
        $user->bio = $request->input('bio');
        $user->images = $request->input('images');

     $list = DB::table('users')
     ->where('id', Auth::user())//条件を追記　ログインしてる人のID
     ->update([
                'username' => $user->username,
                'mail' => $user->mail,
                'password' => $user->password,
                'bio' => $user->bio,
                'images' => $user->images]);
                //dd($user->username);

                return redirect('/top');
    }

    public function search()
    {
    $list = \DB::table('users')->get();//usersテーブルからすべてのレコード情報をゲットする  全員のユーザーが入っている
     $user = Auth::user(); //12/23 追記
        return view('users.search',['list' => $list]);
    }
    public function searching(Request $request)
    {
       $name = $request->input('newPost');
       $list = DB::table('users')
     ->where('username','like','%'. $name . '%')//usernameフィールドに検索テキストを含むレコードをすべて表示する（検索結果を表示）
     ->get();

     $search_result = '検索ワード : '. $name; //検索ワード表示
     //dd($name);
     return view('users.search', [
      'list' => $list,
     'search_result' => $search_result
    ]);//user.searchを表示　blade側で使えるように追記
    }
    }
