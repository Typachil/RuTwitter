<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscriptions;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

    public function subscribe($id, Request $request){
        $user_sub_id = $request->usersubid;
        $subUser = Subscriptions::where('user_sub_id', $user_sub_id)->where('user_id', $id);
        if($subUser->first()){
            $subUser->delete();
            $data = ["subResult" => true];
            return $data;
        }
        Subscriptions::create(['user_id' => $id, 'user_sub_id' => $user_sub_id]);
        $data = ["subResult" => true];
        return $data;
    }
}
