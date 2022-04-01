@extends('layout')

@section('title') Главная страница @endsection

@section('main_content')
    <h1>Последние новости</h1>
    <div class="d-flex flex-column align-items-center justify-content-center">
          @foreach($posts->reverse() as $el)
            <div class="card shadow-sm w-50 mb-5 post">
              <div class="card-header d-flex align-items-center">
                  <img src="img/defaultUserImg.png" alt="Фото пользователя">
                  <div>{{$el->user->name}}</div>
              </div>
              @php $photoSrc = $el->getMedia('media')->first() @endphp
              <img width="50%" height="50%" style="margin: 0 auto" src="{{$photoSrc->getUrl('thumb')}}" alt="Картинка">
              <div class="card-body">
                <h4 class="card-title">{{$el->theme}}</h4>
                <p class="card-text">{{$el->message}}</p>
                <hr>
                <div class="d-flex">
                  <button type="button"><img src="img/like.png" alt="Лайк"></button>
                  <button type="button" class="button-comment"><img src="img/comment.png" alt="Комментарий"></button>
                  <button type="button"><img src="img/repost.png" alt="Репост"></button>
                  <button type="button"><img src="img/share.png" alt="Поделится"></button>
                </div>
                Опубликовано: {{$el->created_at}}
              </div>
              <div class="card-footer text-muted">
                <button>Показать комментарии</button>
                <form action="" class="form-comment mt-3">
                  <img src="img/defaultUserImg.png" width="36" height="36" alt="Аватарка">
                  <input type="text" class="comment w-100" name="comment" placeholder="Напишите комментарий">
                  <button type="submit"><img src="img/send.jpg" alt="Отправить"></button>
                </form>
              </div>
            </div>
          @endforeach
    </div>
    
@endsection