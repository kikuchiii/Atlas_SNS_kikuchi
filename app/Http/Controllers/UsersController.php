<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search()
    {
    $list = \DB::table('users')->get();//usersテーブルからすべてのレコード情報をゲットする  全員のユーザーが入っている
        return view('users.search',['list' => $list]);
    }
    public function searching(Request $request)
    {
       $name = $request->input('newPost');
       $list = DB::table('users')
     ->where('username','like','%'. $name . '%')//usernameフィールドに検索テキストを含むレコードをすべて表示する
     ->get();
     return view('users.search', ['list' => $list]);//ルーティングを経由してsearchに飛ぶ
    }

}
