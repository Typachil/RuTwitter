<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Logout;
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

Route::get('/message', [MainController::class,'message'])->name('message');
Route::post('/message', [MainController::class,'message_check'])->middleware('auth')->name('message_post');

Route::post('/comment_post', [MainController::class,'comment_post'])->name('comment');

Route::name('user.')->group(function(){
    Route::view('/private', 'private')->middleware('auth')->name('private');
    Route::get('/login', function(){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        return view('login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/logout', [MainController::class, 'logout'])->name('logout');

    Route::get('/registration', function(){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        return view('registration');
    })->name('registration');

    Route::post('registration', [RegisterController::class, 'save']);
});