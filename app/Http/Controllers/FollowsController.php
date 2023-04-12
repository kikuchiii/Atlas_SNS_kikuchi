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
                //$following_id = Auth::user()->follows()->pluck('followed_id');
                $list = User::with('follow')
                ->where('id', Auth::user()->id = 'following_id')
                ->get();
                //$list = $user->follows()->wherePivot('followed_id', true)->get();
//whereIn('user_id', $following_id)->get();

                //dd($list);
        //$following_id = Auth::user()->follows()->pluck('followed_id');
        //$followed_id = Follow::orderBy('updated_at', 'desc')
        //->get();
        //$list = \DB::table('users')->get();//リレーションを使う場合はDBデータを取得するのではなくFollowクラスからデータを取得する。なので削除予定
         //Follows::create(['post' => $post]);
        //return view('follows.followList', compact('post'));
        return view('follows.followList', ['list' => $list]);
        //$list = Post::orderBy('created_at', 'desc')->get();
    }
    //public function create()
    //{
        //$followed_id =
        //\DB::table('follows')->insert([
        //'followed_id' => $followed_id,
       //]);
    //}

    public function followerList()
    {
        //followsテーブルのレコードを取得
        $followed_id = Auth::user()->follows()->pluck('followed_id');
        //$followed_users = User::orderBy('updated_at','desc')->whereIn('user_id',$followed_id)->get();
        $list = User::query()->whereIn('id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();

        return view('follows.followerList',
        compact('list'));
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

}
