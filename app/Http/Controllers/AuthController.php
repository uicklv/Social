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

        return redirect()->route('home')->with('info', 'Вы успешно зарегестрировались! Выполните вход.');
    }

    public function getSignIn()
    {
        return view('auth.signin');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required|min:8',
        ] );

        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember')))
        {
            return redirect()->back()->with('info', 'Неверный логин или пароль.');
        }

        $user = Auth::user();
        return redirect()->route('home')->with('info', 'Вы успешно вошли как ' . $user->username);

    }

    public function logout()
    {
        Auth::logout();
        return  redirect()->route('home');
    }
}
