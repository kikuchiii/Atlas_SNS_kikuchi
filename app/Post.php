<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //public function users(): BelongsToMany
    //{
    //return $this->belongsToMany(User::class,'follow')->withPivot('following_id','follow_id');
    //$user = User::find(1);
    //foreach ($user->posts as $post) {
    //dd($post->pivot->following->follow); //中間テーブルにアクセスする
public function user() {
        return $this->belongsTo(User::class);//1対多

    }
}
 //}
//}
