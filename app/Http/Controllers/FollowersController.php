<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Follower;

class FollowersController extends Controller
{
    public function saveFollower(
    	Request $request) {
    	$user = Auth::user();

    	$userId = $user->id;
    	$incomingFollower = $request->follower_id;

    	$follower = new Follower();
    	$follower->user_id = $userId;
    	$follower->tweet = $incomingFollower;
    	$follower->save();

    	return redirect('/home');
    }
}
