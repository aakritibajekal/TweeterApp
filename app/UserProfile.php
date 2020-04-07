<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo( 'App\User' );
    }

    public function posts()
    {
        return $this->hasMany( 'App\Post' );
    }

    public function followers()
    {
        return $this->hasMany( 'App\Follower' )->withTimestamps();
    }

    public function followings()
    {
        return $this->hasMany( 'App\Follower' )->withTimestamps();
    }

    public function likedPosts()
{
    return $this->morphedByMany('App\Post', 'likes')->whereDeletedAt(null);
}

    protected $fillable = [
        'username', 'user_id', 'bio', 'picture'
    ];
}
