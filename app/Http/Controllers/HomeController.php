<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
Use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $appModel = new Post();
        $tweets = $appModel->orderBy('created_at', 'DESC')->with('comment')->get();

        $userModel = new User();
        $users = $userModel->all();
        foreach ($users as $user) {
            
        }
       
        return view('home', compact('tweets'));
        return view('index', ["users"=>$users]);
    }
}
