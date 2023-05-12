<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    protected $fillable = ['following_id','followed_id'];

    protected $table = 'follows';//テーブル名を定義

    //フォロアー数カウント
    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }
}
