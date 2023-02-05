<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Validator;

class PostsController extends Controller
{
    //
    public function index()//表示用
    {
     $list = \DB::table('posts')->get();//登録したものを引っ張ってくる
        return view('posts.index',['list' => $list]);//ビューファイルを引っ張ってくる
    }
    public function create(Request $request)//新規投稿処理
    {
        //dd($request);
        $post = $request->input('newPost');//name属性を受け取り
        //dd($post);
        //['postしてきた値' => '検証ルール']

        $this->validate($post, [
	     'post' => 'required|min:4|max:200',
        ]);
var_dump($this);
        //$requestの中身に対してバリデーションをかけ、問題がない場合は変数に入れている。
       $user_id = Auth::id();//ユーザーIDの受け渡し
       \DB::table('posts')->insert([
        'post' => $post,
        'user_id' => $user_id//
       ]);

        return redirect('/top');//indexに飛ぶ
    }
    public function delete($id)
    {
        \DB::table('posts')
          ->where('id', $id)
           ->delete();

           return redirect('/top');
    }
}
