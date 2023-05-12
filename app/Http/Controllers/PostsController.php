<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\User;

use Validator;

class PostsController extends Controller
{
    //
    public function index()//表示用
    {
     $list = \DB::table('posts')->get();//テーブルからレコード情報取得

        $following_id = Auth::user()->follows()->pluck('followed_id');
        // フォローしているユーザーのidを元に投稿内容を取得
$posts = Post::all();
return view('posts.index',['list' => $list,'posts' => $posts]);//ビューファイルを表示
    }
//$list = Post::orderBy('created_at', 'desc')->get();

    protected function validator(array $post)//新規投稿処理
    {
        //$post = $request->input('newPost');
//バリデーションルール定義
//dd($request);
        return Validator::make($post,[
            'newPost' => 'required|min:3|max:200',
        ]);
    }
    protected function create(array $post)
    //投稿機能
{
    //$post = $request->input();//いらない可能性あり（2/25）
    $user_id = Auth::id();//いらない可能性アリ
    //$user_id = Auth::id();//ユーザーIDの受け渡し
        \DB::table('posts')->insert([
        'post' => $post,
        'user_id' => $user_id//
       ]);
}

        public function creation(Request $request)//バリデーション
        {
            if($request->isMethod('post')){ //post通信でリクエストが送られてきたら
            $user_id = Auth::id();
            $post = $request->input();
            $validator = $this->validator($post);
            //$validator = $this->validator($data);
            //dd($validator);
        if($validator->fails()){
            //エラー時の処理
            return redirect('/top')
                ->withErrors($validator)// Validatorインスタンスの値を$errorsへ保存
                ->withInput();// 送信されたフォームの値をInput::old()へ引き継ぐ

        } else {//成功したときの処理
            //dd($user_id);
            //成功したときの記述
            Post::create([
                'post' => $post[
                    'newPost'
                ],
                'user_id' => $user_id //エラー原因
            ]);
//dd($user_id);
            //$this->create($post);
            return redirect('/top');
            }

        //dd($request);
        //$this->validate($post,[//name属性を受け取り
        //dd($post);
        //['postしてきた値' => '検証ルール']
	     //'post' => 'required|min:4|max:200',
        //],
    //[
        //'post.required' => '投稿内容を入力して下さい',
    //]);

        //$requestの中身に対してバリデーションをかけ、問題がない場合は変数に入れている。
       //$user_id = Auth::id();//ユーザーIDの受け渡し
       //\DB::table('posts')->insert([
        //'post' => $post,
        //'user_id' => $user_id//
      // ]);
       }
       return view('posts.index');
    }
public function update(){

}

    public function delete($id)
    {
        \DB::table('posts')
          ->where('id', $id)
           ->delete();

           return redirect('/top');
    }
}
