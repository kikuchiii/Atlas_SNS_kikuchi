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
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followers()
    {
    return $this->belongsToMany(User::class,'follows','followed_id','following_id');('following_id');
}
public function follows()
{
    return $this->belongsToMany(User::class,'follows','following_id','followed_id');
}
public function posts() {
        return $this->hasMany(Post::class);
}
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['follows.id']);//
    }

    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['follows.id']);
    }


}
