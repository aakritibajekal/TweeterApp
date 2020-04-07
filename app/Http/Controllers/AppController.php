<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //replaced with tweet
use Auth; //Need to pull in Auth in order to use it.
use App\user;
use App\Comment;

class AppController extends Controller
{

    public function saveTweet(Request $request)
    {
    $user = Auth::user();

    $userId = $user->id;
    $incomingTweet = $request->tweet;

    $tweet = new Post();
    $tweet->user_id = $userID;
    $tweet->tweet = $incomingTweet;
    $tweet->save();

    return redirect('/home');
}

public function saveComment(Request $request) {
	$user = Auth::user();

	$userId = $user->id;
	$incomingComment = $request->comment;

	$comment = new Comment();
	$comment->user_id = $userId;
	$comment->tweet_id = $incomingComment;
	$comment->save();

	return function deleteComment($id) {
		$deleteComment = Comment::find($id);
		$deleteComment->delete();
		return redirect('/home');
	}

	public function getTweets(){

		$allTweets = Tweets::all();
		$allTweetsJson = json_encode($allTweets);

		return $allTweetsJson;
	}
}
