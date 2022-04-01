@extends('layout')

@section('title') Регистрация @endsection

@section('main_content')
    <div>
        <h1 class="col-6 offset-5 mb-4">Регистрация</h1>
        <ul class="nav nav-pills nav-justified mb-3 col-6 offset-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
            <a
                class="nav-link"
                id="tab-login"
                href="/login"
                role="tab"
                aria-selected="false"
                >Войти</a
            >
            </li>
            <li class="nav-item" role="presentation">
            <a
                class="nav-link active"
                id="tab-register"
                href="/registration"
                role="tab"
                aria-selected="true"
                >Зарегестрироватся</a
            >
            </li>
        </ul>
        <form class="col-6 offset-3 border rounded p-4" method="POST" action="{{route('user.registration')}}">
            @csrf
            <div class="text-center mb-3">
            <p>Sign up with:</p>
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
        
            <!-- Nickname input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerUsername">Введите никнейм</label>
                <input type="text" id="registerUsername" name="name" class="form-control" />
            </div>
        
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerEmail">Введите Email</label>
                <input type="email" id="registerEmail" name="email" class="form-control" />
                @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        
            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerPassword">Введите пароль</label>
                <input type="password" id="registerPassword" name="password" class="form-control" />
                @error('password')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        
            <!-- Repeat Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerRepeatPassword">Повторите пароль</label>
                <input type="password" id="registerRepeatPassword" name="passwordRepeat" class="form-control" />
                @error('passwordRepeat')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        
            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-center mb-4">
            <input
                class="form-check-input me-2"
                type="checkbox"
                value=""
                id="registerCheck"
                checked
                aria-describedby="registerCheckHelpText"
            />
            <label class="form-check-label" for="registerCheck">
                I have read and agree to the terms
            </label>
            </div>
        
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-3">Зарегестрироватся</button>
        </form>
    </div>
@endsection