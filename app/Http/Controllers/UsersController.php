<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use App\User;

use App\Post;

use App\Follow;

class UsersController extends Controller
{
    //
    public function profile()
    {
        return view('users.profile')->with('user', Auth::user());
    }

    public function update(Request $request)
    {
        //dd($request);
        //フォームから送られてきた値(request)を代入
//$user = $request->input();
//dd($user);
//$image = $request->file('images');
$validator = Validator::make($request->all(), [
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|min:5|max:40|email',
            'password' => 'alpha_num|required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'alpha_num|required|string|min:8|max:20|same:password',
            'bio' => 'max:150',
            'images' => 'image|mimes:jpg,png,bmp,gif,svg',
]);
//　バリデーションが失敗した場合
if ($validator->fails()) {
    //エラー時の処理
    return redirect('/profile')
    ->withErrors($validator)
    ->withInput();
}
 // バリデーションが成功した場合、ここで画像をアップロードする
if ($request->hasFile('images')) {
    $image = $request->file('images');
//画像のオリジナルネームを取得
    $imageName = time() . '_' . $image->getClientOriginalName();
    $path = $image->storeAs('public', $imageName);
        // 画像が正常に保存されたら、成功メッセージを表示するなどの適切な処理を行う

            //return back()->with('success', '画像がアップロードされました。');
} else {
    $path = null; // 画像がアップロードされなかった場合は null をセット
            //return back()->with('error', '画像のアップロードに失敗しました。');

}

 //成功時の処理
     $list = DB::table('users')
     ->where('id', Auth::id())//条件を追記　ログインしてる人のID
     ->update([
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'password' => bcrypt($request->input('password')),
            'bio' => $request->input('bio'),
            'images' => $imageName, // アップロードした画像のパスをセット 画像の名前を入れる
        ]);
                //dd($image);
                //dd($path);
                return redirect('/top');
    }


    public function search()//ログインユーザー以外のユーザーを表示する機能
    {
    $list = \DB::table('users')->get();//usersテーブルからすべてのレコード情報をゲットする  全員のユーザーが入っている
     $user = Auth::user(); //12/23 追記
        return view('users.search',['list' => $list]);
    }
    //Laravelでフォーム機能を使ってリクエストを送信しデータベースに値を格納する際、空文字("")が勝手にnull値に変換されエラーが発生
    public function searching(Request $request)
    {
       $name = $request->input('search');
     //dd($name);
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

    public function yourprofile($id)
    {
        //dd($id);
        //$post = User::where('id', $id)->first();
        //$users= User::query()->where('username',$list)->pluck('id');

        //$posts = Post::with('user')->whereIn('posts.user_id', $users)->get();
//上記は、postsテーブルのuser_idと前述で定義した$usersが一致する投稿を取得するために記述した。
//$following_id = Auth::user()->follows()->pluck('followed_id');//フォローしているidが登録されているカラム名
                //$list = User::whereIn('id', $following_id)
                //->get();
                //$posts = Post::with('user')->whereIn('posts.user_id', $following_id)->get();

                //$profile = User::whereIn('username', $username)->get();
//これだと↓配列型でなければならないエラーが出る
//$posts = Post::with('user')->whereIn('posts.user_id', $id)->orderBy('created_at','desc')->get();

//そのユーザーの投稿を取得する場合は、get()メソッドを使用すればいいが、名前や、プロフィール画像など、そのユーザーの情報だけを受け取る場合は、別のメソッドを使用する必要があります。
                //$profile = Post::where('id' , $id)->get();
                //$profile = DB::table('users')->where('id',$id)->get();
                //$profile = User::find('id', $id);
                //$profile = User::where('id', $id)->first();
                $profile = User::where('id', $id)->first();
                $UserPosts = Post::where('posts.user_id',$id)->get();
                //print_r($profile);
                //var_dump($profile);
                //dd($profile);
                //$post = Post::where('user_id', $id)->orderBy('created_at','desc')->get();
                //dd($post);

//var_dump($profileposts);
return view ('users.yourprofile',[
    'profile' => $profile, 'UserPosts' => $UserPosts]);
    }
}
