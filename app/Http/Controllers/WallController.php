<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class WallController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->allFriends();
        return view('startpage', ['friends' => $friends]);
    }

    public function getAllPosts()
    {
        $friends = Auth::user()->allFriends();
        $posts = new Collection();
        //get all friends posts
        foreach ($friends as $friend)
        {
            $posts = $posts->merge($friend->posts()->get());
        }

        //sorting collection and add fullname
        //add comments in data
        $result = [];
        foreach ($posts->sortByDesc('created_at') as $value)
        {
            $new_value = $value->toArray();
            $new_value['comments'] = $value->comments->toArray();
            foreach ($new_value['comments'] as $k => $c)
            {
                $new_value['comments'][$k]['name'] = User::find($c['user_id'])->getNameorUsername();
                $new_value['comments'][$k]['created_at'] =  \Illuminate\Support\Carbon::parse($c['created_at'])->format('d F Y / H:i ');
            }
            $new_value['name'] = User::find($value['user_id'])->getNameorUsername();;
            $new_value['created_at'] = \Illuminate\Support\Carbon::parse($value['created_at'])->format('d F Y / H:i ');
            $result[] = $new_value;
        }
        return json_encode($result);
    }

}
