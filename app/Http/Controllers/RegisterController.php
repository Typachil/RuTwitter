<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function save(Request $request){
        if(Auth::check()){
            return redirect(route('user.private'));
        };

        //Валидация полей передаваемые пользователем
        $validateFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Проверка почты пользователя на уникальность
        if(User::where('email', $validateFields['email'])->exists()){
            return redirect(route('user.registration'))->withErrors([
                'email' => 'Пользователь с таким email уже существует'
            ]);
        };

        //Проверка пароля на соответствие полю "повторите пароль"
        if($validateFields['password'] !== $request->passwordRepeat){
            return redirect(route('user.registration'))->withErrors([
                'passwordRepeat' => 'Пароли не соотвествуют друг другу'
            ]);
        }

        //Метод create создает пользователя 
        $user = User::create($validateFields);
        if($user){
            Auth::login($user);
            return redirect(route('user.private'));
        };

        return redirect(route('user.registration'))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }
}
