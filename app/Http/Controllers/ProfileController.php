<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function getProfile(User $user)
    {
        if (!$user)
        {
            abort(404);
        }
        $posts = $user->posts()->latest()->get();
        return view('user.profile', ['user' => $user, 'posts' => $posts]);
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function update(\App\User $user, Request $request)
    {
        $this->validate($request, [
            'first_name' => 'alpha|max:255',
            'last_name' => 'alpha|max:255',
            'location' => 'alpha|max:255',
        ] );

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->location = $request->get('location');
        $user->save();

        return redirect()->route('profile.getprofile', ['user' => $user]);
    }
}

