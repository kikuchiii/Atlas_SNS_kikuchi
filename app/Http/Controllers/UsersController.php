<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use App\User;

use App\Post;

class UsersController extends Controller
{
    //
    public function profile()
    {
        return view('users.profile')->with('user', Auth::user());
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        //画像の名前だけデータベースに入れるようにしている
        //$image = $request->file('iconimage')->store('public/images');

        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->password = $request->input('password');
        $user->bio = $request->input('bio');


     $list = DB::table('users')
     ->where('id', Auth::id())//条件を追記　ログインしてる人のID
     ->update([
                'username' => $user->username,
                'mail' => $user->mail,
                'password' => Hash::make($user->password),
                'bio' => $user->bio,
                ]);
                //dd($user->username);
                return redirect('/top');
    }

    public function search()//ログインユーザー以外のユーザーを表示する機能
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

    public function yourprofile($username)
    {
        //$post = User::where('id', $id)->first();
        //$users= User::query()->where('username',$list)->pluck('id');

        //$posts = Post::with('user')->whereIn('posts.user_id', $users)->get();
//上記は、postsテーブルのuser_idと前述で定義した$usersが一致する投稿を取得するために記述した。
//$following_id = Auth::user()->follows()->pluck('followed_id');//フォローしているidが登録されているカラム名
                //$list = User::whereIn('id', $following_id)
                //->get();
                //$posts = Post::with('user')->whereIn('posts.user_id', $following_id)->get();

                //$profile = User::whereIn('username', $username)->get();
                $profile = User::whereIn('username',$username)->first('id');
                //dd($profile);
                //$profileposts = Post::query()->where('posts.user_id',$username)->get('id');
//var_dump($profileposts);
return view ('users.yourprofile',[
    'profile' => $profile ]);
    }
}
