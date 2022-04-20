<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        //Проверка пользователя с помощью аутентификации
        if(Auth::check()){
            return redirect()->intended(route('user.private'));
        };

        //Получение полей email и password
        $formFields = $request->only(['email', 'password']);

        //Проверка введенных данных пользователем 
        if(Auth::attempt($formFields, $request->loginRemember)){
            return redirect()->intended(route('user.private'));
        }

        return redirect(route('user.login'))->withErrors([
            'form' => 'Не удалось авторизоваться'
        ]);
    }
}
