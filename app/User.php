<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\User;
use App\Follow;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ //データ登録させるカラムを指定
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ //表示しないカラムを指定
        'password', 'remember_token',
    ];

    public function followers()
    {
//userモデルのデータを取得する
    return $this->belongsToMany(User::class,'follows','followed_id','following_id')->withPivot('followed_id');// 追加する//　3:自分　4:自分をフォローしている
//
    //$user = User::find(1);

    //foreach ($user->users as $user) {
    //dd($user->pivot); // 1 中間テーブルにアクセスする
 //}

 //$user->users()->attach(3);
}
public function follows()//自分をフォローしている側
{
    return $this->belongsToMany(User::class,'follows','following_id','followed_id');
}

// フォローする 3/16追加
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);//attachメソッド　新たに紐づけする
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);//紐づけ解除
    }

// フォローしているか
    public function isFollowing(Int $user_id)//フォローしているか判定する
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['follows.id']);//
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['follows.id']);
    }
}
