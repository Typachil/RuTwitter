@extends('layout')

@section('title') Мои настройки @endsection

@section('main_content')
    <h1 class="mt-3 mb-4">Настройки</h1>
    <div class="p-3 settings-block">
        <div class="password-block">
            Аватар
            <div class="current-avatars">
                <img src="img/defaultUserImg.png" alt="Avatar">
                <button class="change_button">Изменить</button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="form-control form-control-sm" name="file" id="file" type="file">
                <button type="submit" class="btn-success">Сохранить</button>
            </form>
        </div>
        <div class="password-block">
            Пароль
            <div class="last-change">
                Последнее изменение: 
                {{$user->updated_at}}
                <button class="change_button">Изменить</button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="current-password">
                    Текущий пароль
                    <input type="text" class="form-control" name="current-password" id="current-password" placeholder="Введите пароль">
                </label>
                <label for="new-password">
                    Новый пароль
                    <input type="text" class="form-control" name="new-password" id="new-password" placeholder="Введите пароль">
                </label>
                <label for="new-password_repeat">
                    Повторите пароль
                    <input type="text" class="form-control" name="new-password_repeat" id="new-password_repeat" placeholder="Введите пароль">
                </label>
                <button type="submit" class="btn-success">Сохранить</button>
            </form>
        </div>
        <div class="email-block">
            Email
            <div class="email">
                {{$user->email}}
                <button class="change_button">Изменить</button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="email">
                    Введите новый email
                    <input type="email" class="form-control" name="email" id="email" placeholder="Введите пароль">
                </label>
                <button type="submit" class="btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection