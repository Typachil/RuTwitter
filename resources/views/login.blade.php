@extends('layout')

@section('title') Вход @endsection

@section('main_content')
    <div>
        <h1 class="col-6 offset-5 mb-4">Авторизоваться</h1>
        <ul class="nav nav-pills nav-justified mb-3 col-6 offset-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
            <a
                class="nav-link active"
                id="tab-login"
                href="/login"
                role="tab"
                aria-selected="true"
                >Войти</a
            >
            </li>
            <li class="nav-item" role="presentation">
            <a
                class="nav-link"
                id="tab-register"
                href="/registration"
                role="tab"
                aria-selected="false"
                >Зарегестрироватся</a
            >
            </li>
        </ul>
        @error('messageError')
            <div class="alert alert-info">{{$message}}</div>
        @enderror
        <form class="col-6 offset-3 border rounded p-4" method="POST" action="{{route('user.login')}}">
            @csrf
            <div class="text-center mb-3">
            <p>Sign in with:</p>
            <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-google"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-twitter"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-github"></i>
            </button>
            </div>

            <p class="text-center">or:</p>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="email">Введите Email</label>
                <input type="email" id="email" class="form-control" name="email"/>
                @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="password">Введите пароль</label>
                <input type="password" id="password" class="form-control" name="password"/>
                @error('password')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <!-- 2 column grid layout -->
            <div class="row mb-4">
                <div class="col-md-6 d-flex justify-content-start">
                    <!-- Checkbox -->
                    <div class="form-check mb-3 mb-md-0">
                    <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                    <label class="form-check-label" for="loginCheck"> Запомнить меня </label>
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-end">
                    <!-- Simple link -->
                    <a href="#!">Забыли пароль?</a>
                </div>
            </div>

            @error('form')
                    <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Войти</button>

            <!-- Register buttons -->
            <div class="text-center">
            <p>Не авторизованы? <a href="/registration">Зарегестрироватся</a></p>
            </div>
        </form>
    </div>
@endsection