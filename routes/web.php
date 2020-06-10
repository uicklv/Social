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


Route::get('/alert', function (){
    return redirect()->route('home')->with('info', 'Выполните вход!');
});

//Auth

Route::get('/signup', '\\' . \App\Http\Controllers\AuthController::class . '@index')
    ->name('signup.index')
    ->middleware('guest');
Route::post('/signup', '\\' . \App\Http\Controllers\AuthController::class . '@handle')
    ->name('signup.handle')
    ->middleware('guest');

Route::get('/', '\\' . \App\Http\Controllers\AuthController::class . '@getSignIn')
    ->name('signin.get')
    ->middleware('guest');
Route::post('/', '\\' . \App\Http\Controllers\AuthController::class . '@postSignIn')
    ->name('signin.post')
    ->middleware('guest');

Route::get('/logout',  '\\' . \App\Http\Controllers\AuthController::class . '@logout')
    ->name('logout')
    ->middleware('auth');

//-------------//\

Route::get('/startpage', '\\' . \App\Http\Controllers\WallController::class . '@index')
    ->name('startpage')
    ->middleware('auth');


//search

Route::get('/search', '\\' . \App\Http\Controllers\SearchController::class . '@getResults')
    ->name('search.results')
    ->middleware('auth');

//

Route::get('/user/{user}', '\\' . \App\Http\Controllers\ProfileController::class . '@getProfile')
    ->name('profile.getprofile')
    ->middleware('auth');


Route::get('/profile/edit', '\\' . \App\Http\Controllers\ProfileController::class . '@edit')
    ->name('profile.edit')
    ->middleware('auth');
Route::patch('/profile/{user}', '\\' . \App\Http\Controllers\ProfileController::class . '@update')
    ->name('profile.update')
    ->middleware('auth');


Route::get('/friends', '\\' . \App\Http\Controllers\FriendController::class . '@index')
    ->name('friends.index')
    ->middleware('auth');


Route::post('/post', '\\' . \App\Http\Controllers\PostController::class . '@store')
    ->name('post.store')
    ->middleware('auth');

Route::get('/post', '\\' . \App\Http\Controllers\WallController::class . '@getAllposts')
    ->name('post.getall')
    ->middleware('auth');


Route::post('/comment', '\\' . \App\Http\Controllers\WallController::class . '@addComment')
    ->name('comment.post')
    ->middleware('auth');
