<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [MainController::class,'home'])->name('home');
Route::get('/about', [MainController::class,'about']);
Route::get('/personal_news', [MainController::class,'personal_news'])->middleware('auth')->name('personal_news');;

Route::get('/settings', [MainController::class,'settings'])->middleware('auth')->name('settings');
Route::post('/settings/password', [UserController::class,'change_password'])->middleware('auth')->name('change_password');
Route::post('/settings/email', [UserController::class,'change_email'])->middleware('auth')->name('change_email');
Route::post('/settings/avatar', [UserController::class,'change_avatar'])->middleware('auth')->name('change_avatar');

Route::get('/message', [MainController::class,'message'])->name('message');
Route::post('/message', [PostController::class,'messageCreate'])->middleware('auth')->name('message_post');
Route::get('/message/{id}/show', [PostController::class,'showOneMessage'])->middleware(['confpostuser','auth'])->name('show_oneMessage');
Route::put('/message/{id}/edit', [PostController::class,'editOneMessage'])->middleware(['confpostuser','auth'])->name('edit_oneMessage');
Route::get('/message/{id}/delete', [PostController::class,'delOneMessage'])->middleware(['confpostuser','auth'])->name('del_oneMessage');

Route::post('/message/{id}/like', [PostController::class,'messageLike'])->middleware('auth')->name('message_like');
Route::post('/message/{id}/repost', [PostController::class,'messageRepost'])->middleware('auth')->name('message_repost');
Route::post('/comment_post', [PostController::class,'commentPost'])->name('comment');

Route::name('user.')->group(function(){
    Route::get('/private', [MainController::class,'private'])->middleware('auth')->name('private');
    Route::get('/login', function(){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        return view('login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/registration', function(){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        return view('registration');
    })->name('registration');

    Route::post('registration', [RegisterController::class, 'save']);

    Route::post('/subscribe_user/{id}', [UserController::class, 'subscribe'])->middleware('auth')->name('subscribe');
});

Route::fallback(function (){
    return redirect(route('home'));
});