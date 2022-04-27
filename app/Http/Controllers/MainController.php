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
        return view('home', ['posts' => $posts->all(), 'user' => Auth::user()]);
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

    public function change_password(Request $request){
        $validateFields = $request->validate([
            'password' => 'required',
            'newPassword' => 'required',
            'newPasswordRepeat' => 'required'
        ]);

        if(!Auth::attempt(['id' => Auth::id(), 'password' => $validateFields['password']])){
            return redirect(route('settings'))->withErrors([
                'password' => 'Неправильный пароль'
            ]);
        }

        if($validateFields['newPassword'] !== $validateFields['newPasswordRepeat']){
            return redirect(route('settings'))->withErrors([
                'newPasswordRepeat' => 'Пароли не соотвествуют друг другу'
            ]);
        }

        $user = User::find(Auth::id());
        $user->update(['password' => $validateFields['newPassword']]);

        return redirect(route('settings'))->with('status', 'Пароль успешно обновлен');
    }

    public function change_email(Request $request){
        $validateFields = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::find(Auth::id());
        $user->update($validateFields);

        return redirect(route('settings'))->with('status', 'Email успешно обновлен');
    }

    public function change_avatar(Request $request){
        $user = User::find(Auth::id());

        if($request->hasFile('file'))
        {   
            $user->addMedia($request->file('file'))->toMediaCollection('avatars');
        };
        return redirect(route('settings'))->with('status', 'Аватар успешно обновлен');
    }
}
