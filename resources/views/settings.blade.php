@extends('layout')

@section('title') Мои настройки @endsection

@section('main_content')
    <h1 class="mt-3 mb-4">Настройки</h1>
    <div class="p-3 settings-block">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="block">
            <div class="current-avatar block-change">
                Аватар
                @php $avatarSrc = $user->getMedia('avatars')->first() @endphp
                @if($avatarSrc)
                    <div style='width: 60px; height: 60px;' class="me-2">
                        <img class="settings-avatar" src="{{$avatarSrc->getUrl()}}" alt="Фото пользователя">
                    </div>
                @else 
                    <img src="/img/defaultUserImg.png" alt="Фото пользователя">
                @endif
                <button class="change_button">Изменить</button>
            </div>
            <form method="POST" action="{{route('change_avatar')}}" enctype="multipart/form-data" class="form-edit" id="formAvatarChange">
                @csrf
                Загрузите фото
                <input class="form-control form-control-sm" name="file" id="file" type="file">
                <button type="submit" class="btn-success">Сохранить</button>
            </form>
        </div>
        <div class="block">
            <div class="last-change block-change">
                <div>Пароль</div> 
                <div>Последнее изменение: {{$user->updated_at}}</div>
                <button class="change_button">Изменить</button>
            </div>
            <form method="POST" action="{{route('change_password')}}" class="form-edit" id="formPasswordChange">
                @csrf
                <label for="password">
                    @error('password')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    Текущий пароль
                    <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
                </label>
                <label for="newPassword">
                    Новый пароль
                    <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Введите пароль">
                </label>
                <label for="newPasswordRepeat">
                    @error('passwordRepeat')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    Повторите пароль
                    <input type="password" class="form-control" name="newPasswordRepeat" id="newPasswordRepeat" placeholder="Введите пароль">
                </label>
                <button type="submit" class="btn-success">Сохранить</button>
            </form>
        </div>
        <div class="block">
            <div class="email block-change">
                Email
                {{$user->email}}
                <button class="change_button">Изменить</button>
            </div>
            <form method="POST" action="{{route('change_email')}}" class="form-edit" id="formEmailChange">
                @csrf
                <label for="email">
                    Введите новый email
                    <input type="email" class="form-control" name="email" id="email" placeholder="Введите email">
                </label>
                <button type="submit" class="btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection