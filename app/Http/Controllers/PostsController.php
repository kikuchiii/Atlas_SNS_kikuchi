<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


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
        $post = $request->input('newPost');//name属性を取けとり
        $user_id = Auth::id();//ユーザーIDの受け渡し
        \DB::table('posts')->insert([
            'post' => $post,//投稿内容を表す
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
