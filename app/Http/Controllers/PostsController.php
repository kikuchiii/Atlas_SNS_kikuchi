<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\User;

use App\Follow;

use Validator;

class PostsController extends Controller
{
    //
    public function index()//表示用
    {
        $list = Post::where('user_id' , Auth::id())->first();
        $following_id = Auth::user()->follows()->pluck('followed_id');
        $follow = User::whereIn('id', $following_id)->get();
        $posts = Post::with('user')->whereIn('posts.user_id', $following_id)->get();
return view('posts.index',['list' => $list,'follow' => $follow,'posts' => $posts]);//ビューファイルを表示
    }

    protected function validator(array $post)//新規投稿処理
    {
        return Validator::make($post,[
            'newPost' => 'required|min:3|max:200',
        ]);
    }
    protected function create(array $post)
{
    $user_id = Auth::id();
        \DB::table('posts')->insert([
        'post' => $post,
        'user_id' => $user_id//
       ]);
}

    public function creation(Request $request)
        {
            if($request->isMethod('post')){
            $user_id = Auth::id();
            $post = $request->input();
            $validator = $this->validator($post);

        if($validator->fails()){
            return redirect('/top')
                ->withErrors($validator)
                ->withInput();

        } else {
            Post::create([
                'post' => $post[
                    'newPost'
                ],
                'user_id' => $user_id
            ]);
            return redirect('/top');
            }
       }
       return view('posts.index');
    }

    public function update(Request $request){
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        Post::where('id', $id)->update(['post' => $up_post]);

        return redirect('/top');

}

    public function delete($id)
    {
        \DB::table('posts')
          ->where('id', $id)
           ->delete();

           return redirect('/top');
    }
}
