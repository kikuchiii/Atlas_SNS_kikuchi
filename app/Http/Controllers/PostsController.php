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
        $following_id = Auth::user()->follows()->pluck('followed_id')->toArray();
        array_push($following_id, Auth::id());
        $list = Post::where('user_id' , Auth::id())
        ->orWhere('posts.user_id', $following_id)
        ->orderBy('updated_at','desc')
        ->get();
        //フォローユーザーの画像↓
        $follow = User::whereIn('id', $following_id)->get();
        //$posts = Post::with('user')->whereIn('posts.user_id', $following_id)->get();
return view('posts.index',['list' => $list,'follow' => $follow]);
    }

    protected function validator(array $data, $rules)//新規投稿処理
    {
        return Validator::make($data, $rules,[
            'required' => '入力が必要な項目が未入力です。'
        ]);

    }

    protected function create(array $data)
{
    $user_id = Auth::id();
        \DB::table('posts')->insert([
        'post' => $data['newPost'],
        'user_id' => $user_id//
       ]);
}

    public function creation(Request $request)
        {
            if($request->isMethod('post')){
            $user_id = Auth::id();
            $post = $request->input();
            $validator = $this->validator($post, [
            'newPost' => 'required|min:3|max:200',
        ]);


        if($validator->fails()){
            return redirect('/top')
                ->withErrors($validator)
                ->withInput();

        } else {
             $this->create($post);
            return redirect('/top');
            }
       }
       return view('posts.index');
    }

    public function update(Request $request){
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        $validator = $this->validator(['upPost' => $up_post],[
        'upPost' => 'required|min:3|max:200',
    ],
    );

        if($validator->fails()) {
            return redirect('/top')
                ->withErrors($validator)
                ->withInput();
        } else {
        Post::where('id', $id)->update(['post' => $up_post]);
            return redirect('/top');
            }



        //Post::where('id', $id)->update(['post' => $up_post]);

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
