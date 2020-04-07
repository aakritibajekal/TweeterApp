<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweetlike;

class LikeController extends Controller
{
    public function actOnPost(Request $request, $id)
    {
        $action = $request->get('action');
        switch ($action) {
            case 'Like':
                Post::where('id', $id)->increment('likes_count');
                break;
            case 'Unlike':
                Post::where('id', $id)->decrement('likes_count');
                break;
        }
        event(new PostAction($id, $action)); // fire the event
        return '';
    }
