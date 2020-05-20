<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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

        return redirect()->route('home')->with('info', 'Вы успешно зарегестрировались! Выполните вход.');
    }
}
