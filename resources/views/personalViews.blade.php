@extends('layout')

@section('title') Ваша лента @endsection

@section('main_content')
    <h1 class="d-flex justify-content-center mb-4">Интересное</h1>
    @error('error')
        <div class="alert alert-danger">{{$message}}</div>
    @enderror
    <div class="d-flex flex-column align-items-center justify-content-center">
          @foreach($posts->reverse() as $el)
            <div class="card shadow-sm w-50 mb-5 post">
              @php 
                $postMediaSrc = $el->getMedia('media')->first(); 
                $avatarSrc = $el->user->getMedia('avatars')->first(); 
              @endphp
              <div class="card-header d-flex align-items-center">
                  @if ($avatarSrc)
                    <div style='width: 60px; height: 60px;' class="me-2">
                      <img class="post-avatar" src="{{$avatarSrc->getUrl()}}" alt="Картинка">
                    </div>
                  @else
                    <img src="img/defaultUserImg.png" alt="Фото пользователя">
                  @endif
                  <div class="me-2">{{$el->user->name}}</div>
                  @if ($user->id !== $el->user->id)
                    <button
                        @if ($user->subscribeUsers->where('user_sub_id', $el->user->id)->first())
                            class="btn btn-outline-primary subscribe-button" 
                        @else
                            class="btn btn-primary subscribe-button"  
                        @endif
                        data-userId="{{$user->id}}" 
                        data-userSubId="{{$el->user->id}}">
                        Отслеживать
                    </button>
                  @endif
              </div>
              @if ($postMediaSrc)
                @if ($postMediaSrc->mime_type=='video/mp4' || $postMediaSrc->mime_type=='video/webm')
                  <video width="50%" height="50%" controls="controls" style="margin: 0 auto">
                    <source src="{{$postMediaSrc->getUrl()}}" type='{{$postMediaSrc->mime_type}}'>
                  </video>
                @else
                  <img width="50%" height="50%" style="margin: 0 auto" src="{{$postMediaSrc->getUrl()}}" alt="Картинка">
                @endif
              @endif
              <div class="card-body">
                <h4 class="card-title">{{$el->theme}}</h4>
                <p class="card-text">{{$el->message}}</p>
                <hr>
                <div class="d-flex social-button">
                  <div class="social-like">
                    <button type="button" 
                        @if ($user)
                          data-userId="{{$user->id}}" 
                        @endif
                        data-postId="{{$el->id}}">
                    <img width="32px" height="32px" src="img/like.png" alt="Лайк"
                      @if (!in_array($user->id ,json_decode($el->likes)))
                        class="button-like_color"
                      @endif
                    ></button>
                    <span>{{count(json_decode($el->likes))}}</span>
                  </div>
                  <div class="social-comments">
                    <button type="button" class="button-comment"><img src="img/comment.png" alt="Комментарий"></button>
                    {{count($el->comments)}}
                  </div>
                  <div class="social-repost">
                    <button type="button"
                      @if ($user)
                        data-userId="{{$user->id}}" 
                      @endif
                      data-postId="{{$el->id}}">
                      <img src="img/repost.png" alt="Репост">
                      <span>{{count($el->reposts)}}</span>
                    </button>
                  </div>
                  <div class="social-share">
                    <button type="button"><img src="img/share.png" alt="Поделится"></button>
                  </div>
                </div>
                Опубликовано: {{$el->created_at}}
              </div>
              <div class="card-footer">
                <button class="text-primary mb-2 button-showComments">Показать комментарии</button>
                <div class="comments-list">
                  @foreach ($el->comments as $comment)
                    <div class="comment d-flex">
                      @php $commentAvatarSrc = $comment->user->getMedia('avatars')->first() @endphp
                      @if ($commentAvatarSrc)
                        <div style='width: 60px; height: 60px;' class="me-2">
                          <img class="comment-user_avatar" src="{{$commentAvatarSrc->getUrl()}}" alt="Картинка">
                        </div>
                      @else
                        <img src="img/defaultUserImg.png" alt="Фото пользователя">
                      @endif
                      <div>
                        <div class="comment-user_name">{{$comment->user->name}}</div>
                        <div class="comment-message">{{$comment->message}}</div>
                      </div>
                    </div>
                  @endforeach
                </div>
                <form method="POST" action="{{route('comment')}}" class="form-comment mt-3">
                  @csrf
                  @php
                    $currentAvatarSrc = null;
                    if($user) $currentAvatarSrc = $user->getMedia('avatars')->first();
                  @endphp
                  @if ($currentAvatarSrc)
                    <div style='width: 36px; height: 36px;' class="me-2">
                      <img class="comment-user_avatar" src="{{$currentAvatarSrc->getUrl()}}" alt="Картинка">
                    </div>
                  @else
                    <img src="img/defaultUserImg.png" width="36" height="36" alt="Аватарка">
                  @endif
                  <input type="text" class="comment w-100" name="message" placeholder="Напишите комментарий">
                  <input type="hidden" id="postId" name="postId" value="{{$el->id}}">
                  <button type="submit"><img src="img/send.jpg" alt="Отправить"></button>
                </form>
              </div>
            </div>
          @endforeach
    </div>
    
@endsection