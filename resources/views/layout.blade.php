<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" rel="icon" href="favicon.png">
    <title>@yield('title') | Chirrup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"  type="text/css" href="/css/app.css">
</head>

<body>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img width="64px" height="64px" src="/img/Chirrup.png" alt="Лого">
                    <h1>Chirrup</h1>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/personal_news" class="nav-link px-2 text-white">Ваша лента</a></li>
                    <li><a href="/message" class="nav-link px-2 text-white">Чирикнуть</a></li>
                    <li><a href="/about" class="nav-link px-2 text-white">О нас</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control form-control-dark" placeholder="Поиск..." aria-label="Search">
                </form>
                <div class="text-end">
                    @if ($authUser)
                        <a href="/private" class="profile">
                            @php $avatarSrc = $user->getMedia('avatars')->first() @endphp
                            @if($avatarSrc)
                                <div style='width: 60px; height: 60px;' class="me-2">
                                    <img class="header-avatar" src="{{$avatarSrc->getUrl()}}" alt="Фото пользователя">
                                </div>
                            @else 
                                <img src="/img/defaultUserImg.png" alt="Фото пользователя">
                            @endif
                        </a>
                        <div class="profile-popup flex-column justify-content-around">
                            <a href="{{route('settings')}}"><button type="button" class="btn btn-warning mb-2">Редактировать</button></a>
                            <a href="/logout"><button type="button" class="btn btn-danger w-100">Выйти</button></a>
                        </div>
                    @else
                        <a href="/login"><button type="button" class="btn btn-outline-light me-2">Войти</button></a>
                        <a href="/registration"><button type="button" class="btn btn-warning">Зарегестрироватся</button></a>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        @yield('main_content')
    </div>

    <footer class="p-3 bg-dark text-white mt-3">
        <div class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>© 2017–2021 Company, Inc. 
                ·<a href="#">Privacy</a>
                ·<a href="#">Terms</a>
            </p>
        </div>
    </footer>
</body>
<script src="/js/app.js"></script>
</html>