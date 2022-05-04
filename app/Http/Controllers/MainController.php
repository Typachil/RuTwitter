<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Repost;

class MainController extends Controller
{
    public function home(){
        //Метод Post::all() передает все записи таблицы
        return view('home', ['posts' => Post::all(), 'user' => Auth::user()]);
    }

    public function about(){
        return view('about');
    }

    public function personal_news(){
        $user = Auth::user();
        $postsUser = $user->posts;
        $postsSubUser = Post::all()->whereIn('user_id', $user->subscribeUsers->pluck('user_sub_id'));
        $posts = $postsUser->merge($postsSubUser);
        return view('personalViews', ['posts' => $posts, 'user' => Auth::user()]);
    }

    public function settings(){
        $user = Auth::user();
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

    public function private(){
        $user = Auth::user();
        $postsUser = $user->posts;
        $postsRepostsUser = Post::all()->whereIn('id', Repost::all()->where('user_id', $user->id)->pluck('post_id'));
        $posts = $postsUser->merge($postsRepostsUser);
        return view('private', ['posts' => $posts, 'user' => Auth::user()]);
    }
}
