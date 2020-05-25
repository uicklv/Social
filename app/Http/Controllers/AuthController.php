<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function handle(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ] );

        $user = new User();
        $user->id = Uuid::uuid4();
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        if (Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])) {
            $user = Auth::user();
            $user->createToken('token-name');
            return response()->json([], 200);
        }

        return response()->json([], 401);

    }

    public function getSignIn()
    {
        return view('auth.signin');
    }

    public function postSignIn(Request $request)
    {
        if (request()->user()) {
            return response()->json([], 403);
        }

        $email = request()->get('email', null);
        $password = request()->get('password', null);
        $remember = request()->get('remember', 0);

        //return response()->json([$email, $pas], 401);

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $user = Auth::user();
            $user->createToken('token-name');
            return response()->json([], 200);
        }

        return response()->json([], 401);

    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        Auth::logout();
        return  redirect()->route('signin.get');
    }
}
