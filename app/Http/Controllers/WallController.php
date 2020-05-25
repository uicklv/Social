<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;

class WallController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->allFriends();
        return view('startpage', ['friends' => $friends]);
    }

}
