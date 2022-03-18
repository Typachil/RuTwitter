@extends('layout')

@section('title') Что нового? @endsection

@section('main_content')
    <h1>Что у вас нового?</h1>
    <div class="row justify-content-center border border-secondary rounded p-3">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="/message/check">
            @csrf
            <div class="mb-3">
                <label for="theme" class="form-label">Тема сообщения</label>
                <input type="text" class="form-control" name="theme" id="theme" placeholder="Введите тему сообщения">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Чем вы хотите поделится?</label>
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Ваше сообщение"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFileSm" class="form-label">Прикрепите файл</label>
                <input class="form-control form-control-sm" name="media" id="formFileSm" type="file">
              </div>
            <button type="submit" class="btn-success">Чирикнуть</button>
        </form>
    </div>
@endsection