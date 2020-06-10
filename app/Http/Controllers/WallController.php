<?php


namespace App\Http\Controllers;


use App\Comment;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

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
            //refresh keys in collection
            $comments = new Collection();
            foreach($value->comments()->get()->sortBy('created_at') as $v)
            {
                $comments[] = $v;
            }
            $new_value['comments'] = $comments->toArray();


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

    public function addComment()
    {
        request()->validate([
            'user_id' => 'required|uuid',
            'post_id' => 'required|uuid',
            'comment' => 'required|min:1|max:1000',
        ]);

        $comment = new Comment();
        $comment->id = Uuid::uuid4();
        $comment->post_id = request()->get('post_id');
        $comment->user_id = request()->get('user_id');
        $comment->caption = request()->get('comment');
        $comment->save();

        return response([], 200);
    }

}
