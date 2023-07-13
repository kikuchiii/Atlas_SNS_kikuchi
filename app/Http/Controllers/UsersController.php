<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

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

protected function validator(array $user)
{
// 記述方法：Validator::make('値の配列', '検証ルールの配列');

return Validator::make($user, [
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|min:5|max:40|email',
            'password' => 'required|string|min:8|max:20|alpha_dash|confirmed',
            'bio' => 'max:150',
            'image' => 'image|mine:jpg,png,gif',
]);
}

    public function update(Request $request)
    {
        //dd($request);
        //$data = $request->all();
        //$user = Auth::user();
        //画像の名前だけデータベースに入れるようにしている
        //$image = $request->file('iconimage')->store('public/images');

        $username= $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');
        //$image = $request->file('image');

//画像更新
//if($request->hasFile('image')){
    //$path = \Storage::put('/public',$image);
    //$path = explode('/',$path);
//$file_name  = $request->file('image')->getClientOriginalName();
//画像のオリジナルネームを取得
//$user->image = $request->file('image')->storeAs('public',$file_name);//画像を保存して、そのパスを$imageに保存
//} else {
    //空の場合の記述
    //$path = null;
//}
// 保存
  //$request =
  $user = $request->all();
  $validator = $this->validator($user);
if($validator->fails()){
    //エラー時の処理
    return redirect('/profile')
    ->withErrors($validator)
    ->withInput();
} else {
 //成功時の処理
     $list = DB::table('users')
     ->where('id', Auth::id())//条件を追記　ログインしてる人のID
     ->update([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($request['password']),
                'bio' => $bio,
                //'image' => $path,
                ]);
                //dd($user->username);
                return redirect('/top');
    }
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
