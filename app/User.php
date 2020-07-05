<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'username', 'password', 'first_name', 'last_name', 'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function getName()
    {
        if ($this->first_name && $this->last_name)
        {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name)
        {
            return $this->first_name;
        }
        return null;
    }

    public function getNameorUsername()
    {
       return $this->getName() ?: $this->username;
    }

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email)?d=mp&&s=60 }}";
    }

    public function friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function allFriends()
    {
        return $this->friends()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function checkFriend(User $friend)
    {
        $user = Auth::user();
        $isFriend = $user->allFriends()->contains($friend);

        $isRequest = Db::table('friends')
            ->where('user_id', $user->id)
            ->where( 'friend_id', $friend->id)
            ->where( 'accepted', 0)
            ->orWhere(function($query) use ($user, $friend) {
                $query->where('friend_id', $user->id)
                    ->where('user_id', $friend->id)
                    ->where( 'accepted', 0);
            })->get();
//        $isRequest = DB::select('SELECT id, user_id, friend_id, accepted FROM friends WHERE (user_id = ' . $user->id . ' AND friend_id = ' . $friend->id . ')
//            OR (user_id = ' . $friend->id . ' AND friend_id = ' . $user->id .')');
        return ['isFriend' => $isFriend, 'isRequest' => $isRequest];
    }


}
