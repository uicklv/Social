<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Ramsey\Uuid\Uuid;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->allFriends();
        $requests = Auth::user()->friendRequests();
        return view('user.friends', ['friends'=> $friends, 'requests' => $requests]);
    }

    public function addFriend()
    {
        $this->validate(\request(), [
            'user' => 'required|uuid',
            'friend' => 'required|uuid',
        ] );

            $insert = DB::table('friends')->insert(
                [
                    'id' => Uuid::uuid4(),
                    'user_id' => \request()->get('user'),
                    'friend_id' => \request()->get('friend'),
                    'accepted' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
            if ($insert)
                return response('[]', 200);
            else
                return response('Error', 500);
    }

    public function deleteFriend()
    {
        $this->validate(\request(), [
            'user' => 'required|uuid',
            'friend' => 'required|uuid',
        ] );

        $friend = Db::table('friends')
            ->where('user_id', \request()->get('user'))
            ->where( 'friend_id', \request()->get('friend'))
            ->orWhere(function($query) {
                $query->where('friend_id', \request()->get('user'))
                ->where('user_id', \request()->get('friend'));
        });

        if($friend->delete())
            return response('[]', 200);
        else
            return response('Error', 500);
    }

    public function  acceptRequest()
    {
        $this->validate(\request(), [
            'user' => 'required|uuid',
            'friend' => 'required|uuid',
        ] );

        $update = DB::table('friends')
            ->where('user_id', \request()->get('friend'))
            ->where('friend_id', \request()->get('user'))
            ->update(['accepted' => 1]);
        if ($update)
            return response('[]', 200);
        else
            return response('Error', 500);

    }



}
