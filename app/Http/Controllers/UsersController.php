 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follower;

class UsersController extends Controller
{
    //
    public function showUsers(Request $request){
    	$users = $userModel->all();
    	foreach ($users as $user) {
    		echo "<p>" . $user->user . "</p>";
    	}
    }

    public Function getUsers(){
    	return json_encode(User::all());
    }
}