<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index()
    {

        return view('posts.index');//ビューファイルを引っ張ってくる
    }
    public function create(Request $request)
    {
        $post = $request->input('newPost');//name属性を取けとり
        \DB::table('posts')->insert([
            'post' => $post
        ]);

        return redirect('index');
    }
    public function store(Request $request)//コンストラクタインジェクション データを作成しデータベースに保存する  消去　
    {
        $this->validate($request, [
            'post' => 'required|min:1|max:200',
        ]);
        $post = new Item;
        //フォームから送られてきたデータをそれぞれ代入
        $post->user_id = Auth::user()->id; //ユーザーIDの受け渡し
        //データベースに保存
        $post->save();

        return redirect('index');//indexに飛ぶ
    }
}
