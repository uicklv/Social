<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class WallController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->allFriends();
        $posts = $this->getAllPosts();
        return view('startpage', ['friends' => $friends, 'posts' => $posts]);
    }

    public function getAllPosts()
    {
        $friends = Auth::user()->allFriends();
        $posts = new Collection();
        foreach ($friends as $friend)
        {
            $posts = $posts->merge($friend->posts()->get());
        }
        return $posts->sortByDesc('created_at');
    }

}
