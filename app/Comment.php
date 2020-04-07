<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function profiles()
    {
    	return $this->belongsTo( 'App\Profile' );
    }

    public function posts()
    {
    	return $this->belongsTo( 'App\Post' );
    }

    public function replies()
    {
    	return $this->hasMany(Comment::class, 'id');
    }
    public function likes()
    {
    	return $this->hasMany('App\Tweetlike')
    }
}
