<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //
    protected $fillable = ['profile_id', 'follower_id', 'followed'];

    protected $primarykey = 'profile_id';

    public function profiles()
    {
    	return $this->belongsTo(Profile::class)
    }
}
