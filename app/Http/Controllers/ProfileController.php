<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\UserProfile;
use App\User;
use App\comment;
use App\Follower;

class ProfileController extends Controller
{
    //
public function index()
{
	$profiles = UserProfile::query( )
        ->join( 'users', 'profiles.user_id', '=', 'users.id' ) 
        ->get(); 

        $posts = Post::all();
       
        $profile = UserProfile::find($profile_id);

        return view('profiles.index', compact('profiles', 'posts', 'profile'));
}

public function create()
{
	$user = Auth::user();
	if ( $user )
		return view('profiles.create');
	else
		return redirect('/posts');
}
public function store(Request $request)
    {
        if ( $user = Auth::user() ) //only store data if user is logged in. 
        {

        $validatedData = $request->validate(array( 
            'username' => 'required|max:25',
            'bio' => 'max:255'
           

        ));
        $user = Auth::user();

        $profile = Profile::where("user_id", "=", $user->id)->firstOrFail();

        $profile->user_id = $user->id;
        $profile->username = $validatedData['username'];
        $profile->bio = $validatedData['bio'];
        $profile->picture = 'picture';
        $profile->save();
        
    
         return redirect('/posts')->with('success', 'Profile saved.');
        }
         return redirect('/posts');
    }
    public function show($id)
    {
        $user = Auth::user();

        $profile = Profile::where("user_id", "=", $user->id)->firstOrFail();

        $post = Post::findOrFail($id);

        $posts = Post::query( )
            ->join( 'profiles', 'posts.profile_id', '=', 'profiles.id' )
            ->select( 'posts.id',
            'profiles.id as profile_ID',
            'profiles.username',
            'profiles.bio',
            'profiles.picture as profile_picture',
            'posts.posted_at',
            'posts.posted_at',
            'posts.content',
            'posts.picture',
            'posts.likes_count',  )
            ->orderBy('posts.id', 'desc')
            ->get(); 

        return view ('profiles.show', compact('profile', 'post', 'posts') );
    }
    public function edit($id)
    {
        if ( $user = Auth::user() ) {

            $profile = profile::findOrFail($id);


            return view( 'profiles.edit', compact('profile') );
        }
        return redirect('/posts');
    }
        public function update(Request $request, $id)
    {
        if ( $user = Auth::user() ) {
            $validatedData = $request->validate(array( 
                'username' => 'required|max:25',
                'bio' => 'max:255',
             ));
    
             Profile::whereId($id)->update($validatedData);
             return redirect('/posts')->with('success', 'Profile updated.');
            }
            return redirect('/posts');
    }

        public function destroy($id)
    {
        if ( $user = Auth::user() ) {
            $profile = Profile::findOrFail($id);
    
            $profile->delete();
    
            return redirect('/posts')->with('success', 'Profile deleted.');
        }
        return redirect('/posts');
    }
        public function showPost($id)
    {
        $posts = Post::query( )
        ->join( 'posts', 'posts.profile_id', '=', 'profiles.id' ) 
        ->get(); 
    }

        public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)->firstOrFail();
    }
        public function followProfile($id)
    {
        $follow = New Follower;
        $follow->profile_id = profile()->id;
        $follow->follower_id = $id;
        $follow->followed = 1;
        $follow->save();

        return redirect()->back();

    }

    public function UnfollowProfile($id)
    {
        $follow = Follower::where('profile_id', profile()->id)
                    ->where('follower_id', $id)
                    ->delete();

                    return redirect()->back();
    }
}









