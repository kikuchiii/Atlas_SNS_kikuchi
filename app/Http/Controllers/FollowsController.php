<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

use App\Post;

use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList() //ログインしているユーザーがフォローしているユーザーを表示する機能
    //followsテーブルのレコードを取得
    {
                $following_id = Auth::user()->follows()->pluck('followed_id');//フォローしているidが登録されているカラム名
                $follow = User::whereIn('id', $following_id)
                ->get();
                $posts = Post::with('user')->whereIn('posts.user_id', $following_id)->orderBy('created_at','desc')->get();
                //dd($follow);
        //$followed_id = Follow::orderBy('updated_at', 'desc')
         //Follows::create(['post' => $post]);
        return view('follows.followList', ['follow' => $follow,'posts' => $posts]);
    }

    public function followerList()
    {
        //followsテーブルのレコードを取得
        $followed_id = Auth::user()->followers()->pluck('following_id');
        //$followed_users = User::orderBy('updated_at','desc')->whereIn('user_id',$followed_id)->get();
        $followed = User::whereIn('id', $followed_id)
        ->get();
        $followedposts = Post::with('user')->whereIn('posts.user_id', $followed_id)->get();
//dd($followed);
        return view('follows.followerList',['followed' => $followed,'followedposts' => $followedposts]);
    }

        // フォロー
    public function follow($list)
    {
        //dd($list);
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($list);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($list);
            return back();
        }
    }

    // フォロー解除
    public function unfollow($list)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($list);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($list);
            return back();
        }
    }

        public function delete($id)
    {
        \DB::table('follows')
            ->where('id', $id)
            ->delete();

        return redirect('users.search');
    }

    //public function followCounts(){
  // WHEREでpostsテーブルのuser_idカラムとログインしているユーザーのidが一致している投稿を取得
  //$following_id = Auth::user()->follows()->pluck('followed_id');
  //$followCounts = User::whereIn('id', $following_id)->get();
  //return view('layouts.login',['followCounts' => $followCounts]);
  //return view('yyyy', compact('posts'));
//}
//フォロー数カウント
public function show(User $user, Follow $follow){
    $follower_count = $follow->getFollowerCount($user->id);

    return view('layouts.login',['follower_count' => $follower_count,
    ]);
}
}
