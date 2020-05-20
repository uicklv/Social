<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', '\\' . \App\Http\Controllers\HomeController::class . '@index')->name('home');

Route::get('/alert', function (){
    return redirect()->route('home')->with('info', 'Выполните вход!');
});

//Auth

Route::get('/signup', '\\' . \App\Http\Controllers\AuthController::class . '@index')->name('signup.index');
Route::post('/signup', '\\' . \App\Http\Controllers\AuthController::class . '@handle')->name('signup.handle');;
