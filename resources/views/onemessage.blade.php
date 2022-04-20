@extends('layout')

@section('title') Редактирование @endsection

@section('main_content')
    <h1 class="mt-3 mb-4">Редактирование сообщения</h1>
    <div class="row justify-content-center border border-secondary rounded p-3" style="margin-bottom: 30%">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" enctype="multipart/form-data" action="{{route('edit_oneMessage', $data->id)}}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="theme" class="form-label">Тема сообщения</label>
                <input type="text" class="form-control" name="theme" id="theme" placeholder="Введите тему сообщения" value="{{$data->theme}}">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Чем вы хотите поделится?</label>
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Ваше сообщение">{{$data->message}}</textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Прикрепите файл</label>
                <input class="form-control form-control-sm" name="file" id="file" type="file">
              </div>
            <button type="submit" class="btn-success">Сохранить</button>
        </form>
    </div>
@endsection