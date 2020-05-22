<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->allFriends();
        $requests = Auth::user()->friendRequests();
        return view('user.friends', ['friends'=> $friends, 'requests' => $requests]);
    }

}
