<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
//use App\UserProfile;
use App\User;
use App\Comment;
use App\Follower;

class PostController extends Controller
{
    //
    public function index()
    {
    	if ( $user = Auth::user() )
    	{
    		//$profile = UserProfile::where("user_id", "=", $user->id)->firstOrFail();

    		$tweets = Post::query( )
    		->join( 'users', 'posts.user_id', '=', 'post_id')
    		->select( 'posts.id')
    		->get();

    		$post = Post::where("profile_id", "=", $profile->id)->first();

    		return view('posts.index', compact('tweets', 'users',) );
    	} else
    	$tweets = Post::query( );
    	return view('posts.index', compact('tweets'));
    }

    public function create()
    {
    	$user = Auth::user();
    	if ( $user )
    		return view('posts.create');
    	else
    		return redirect('/posts');
    }
    public function store(Request $request)
    {
    	if ( $user = Auth::user() )
    	{
    		$validatedData = $request->validate(array('content' => 'required|max:255', ));
    	//	$profile = Profile::where("user_id", "=", $user->id)->findOrFail();
    		$post = new Post();
    	//	$post->profile_id = $profile->id;
    		$post->content = $validatedData['content'];
    		$post->picture = 'picture';
    		$post->save();

    		return redirect('/posts')->with('success', 'Post saved.');
    	}
    	return redirect('/posts');
    }	

    public function show($id)
    {
    	$post = Post::findOrFail($id);

        $profile = Profile::findOrFail($post->profile_id);

        return view( 'posts.show', compact('post', 'profile') );
    }

        public function edit($id)
    {
        if ( $user = Auth::user() ) {
            
            $post = Post::findOrFail($id);

            return view( 'posts.edit', compact('post') );
        }
        return redirect('/posts');
    }

    public function update(Request $request, $id)
    {
        if ( $user = Auth::user() ) {
            $validatedData = $request->validate(array( 
                'content' => 'required|max:255',
             ));
    
             Post::whereId($id)->update($validatedData);

             return redirect('/posts')->with('success', 'Post updated.');
            }
            return redirect('/posts');
    }

    public function destroy($id)
    {
        if ( $user = Auth::user() ) {
            $post = Post::findOrFail($id);
    
            $post->delete();
    
            return redirect('/posts')->with('success', 'Post deleted.');
        }
        return redirect('/posts');
    }

    // public function showProfile($id)
    // {
    //     $profiles = Profile::query( )
    //     ->join( 'profiles', 'posts.profile_id', '=', 'profiles.id' ) 
    //     ->get();
    // }
}



























