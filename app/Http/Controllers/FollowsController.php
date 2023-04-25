<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList() //ログインしているユーザーがフォローしているユーザーを表示する機能
    //followsテーブルのレコードを取得
    {
                $following_id = Auth::user()->follows()->pluck('followed_id');//フォローしているidが登録されているカラム名
                $list = User::whereIn('id', $following_id)
                ->get();
                //'<>', $user_id
                //$list = $user->follows()->wherePivot('followed_id', true)->get();
//whereIn('user_id', $following_id)->get();

                //dd($list);
        //$following_id = Auth::user()->follows()->pluck('followed_id');
        //$followed_id = Follow::orderBy('updated_at', 'desc')
         //Follows::create(['post' => $post]);
        //return view('follows.followList', compact('post'));
        return view('follows.followList', ['list' => $list]);
        //$list = Post::orderBy('created_at', 'desc')->get();
    }

    public function followerList()
    {
        //followsテーブルのレコードを取得
        $followed_id = Auth::user()->follows()->pluck('followed_id');
        //$followed_users = User::orderBy('updated_at','desc')->whereIn('user_id',$followed_id)->get();
        $followed = User::whereIn('id', $followed_id)
        ->get();
//dd($followed);
        return view('follows.followerList',['followed' => $followed]);
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

    public function followCounts(){
  // WHEREでpostsテーブルのuser_idカラムとログインしているユーザーのidが一致している投稿を取得
  $followCounts = User::whereIn('id', $following_id)->get();
  return view('layouts.login',['followCounts' => $followCounts]);
  //return view('yyyy', compact('posts'));
}
}
