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
    public function followList()

    {
                $following_id = Auth::user()->follows()->pluck('followed_id');
                $follow = User::whereIn('id', $following_id)
                ->get();
                //dd($follow);
                $posts = Post::with('user')->whereIn('posts.user_id', $following_id)->orderBy('created_at','desc')->get();
        return view('follows.followList', ['follow' => $follow,'posts' => $posts]);
    }

    public function followerList()
    {
        $followed_id = Auth::user()->followers()->pluck('following_id');
        $followed = User::whereIn('id', $followed_id)
        ->get();
        $followedposts = Post::with('user')->whereIn('posts.user_id', $followed_id)->get();
        return view('follows.followerList',['followed' => $followed,'followedposts' => $followedposts]);
    }
    //フォローする
    public function follow($list)
    {
        $follower = auth()->user();
        // フォローしている確認する文です。
        $is_following = $follower->isFollowing($list);
        if(!$is_following) {
        // フォローしていなければフォローする文です。
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
public function show(User $user, Follow $follow){
    $follower_count = $follow->getFollowerCount($user->id);

    return view('layouts.login',['follower_count' => $follower_count,
    ]);
}
}
