<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MainController extends Controller
{
    public function home(){
        //Объявление модели Post
        $posts = new Post();
        //Метод $posts->all() передает все записи таблицы
        return view('home', ['posts' => $posts->all()]);
    }

    public function about(){
        return view('about');
    }

    public function settings(){
        $user = User::find(Auth::id());
        return view('settings', ['user' => $user]);
    }

    public function message(){
        if(Auth::check()){
            return view('message');
        }else{
            return redirect(route('user.login'))->withErrors([
                'messageError' => 'Войдите, чтобы публиковать посты'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
