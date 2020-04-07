<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public $timestamps = false;

    protected $guarded = [];

    protected $dates = ['deleted_at'];
    //
    protected $fillable = array(  
        'content',
        'picture',
        'likes_count',
        'posted_at'
    );

    public function profiles()
    {
        return $this->belongsTo( 'App\UserProfile' );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
