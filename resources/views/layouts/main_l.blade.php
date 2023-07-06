<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <div class="header-left">
                <div class="header-left-block">
                    <img src="" alt="">
                </div>
                <div class="header-left-block">
                    <span>2023</span>
                </div>
            </div>
            <div class="header-right">
                <div class="header-right-block">
                    <a href="https://t.me/eternal_droqc" target="_blank">
                        <svg id="tg-svg" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="28px" height="28px">
                            <path id="tg" fill="#5b5b5b" d="M34,15l-3.7,19.1c0,0-0.2,0.9-1.2,0.9c-0.6,0-0.9-0.3-0.9-0.3L20,28l-4-2l-5.1-1.4c0,0-0.9-0.3-0.9-1	c0-0.6,0.9-0.9,0.9-0.9l21.3-8.5c0,0,0.7-0.2,1.1-0.2c0.3,0,0.6,0.1,0.6,0.5C34,14.8,34,15,34,15z"/>
                            <path fill="#181818" d="M29.9,18.2c-0.2-0.2-0.5-0.3-0.7-0.1L16,26c0,0,2.1,5.9,2.4,6.9c0.3,1,0.6,1,0.6,1l1-6l9.8-9.1	C30,18.7,30.1,18.4,29.9,18.2z"/>
                        </svg>                      
                    </a>
                </div>
                <div class="header-right-block" style="margin: 0;">
                    <a href="https://vk.com/eternal_droqc" target="_blank">
                        <svg id="vk-svg" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="32px" height="32px">
                            <path id="vk" fill="#5b5b5b" d="M35.937,18.041c0.046-0.151,0.068-0.291,0.062-0.416C35.984,17.263,35.735,17,35.149,17h-2.618 c-0.661,0-0.966,0.4-1.144,0.801c0,0-1.632,3.359-3.513,5.574c-0.61,0.641-0.92,0.625-1.25,0.625C26.447,24,26,23.786,26,23.199 v-5.185C26,17.32,25.827,17,25.268,17h-4.649C20.212,17,20,17.32,20,17.641c0,0.667,0.898,0.827,1,2.696v3.623 C21,24.84,20.847,25,20.517,25c-0.89,0-2.642-3-3.815-6.932C16.448,17.294,16.194,17,15.533,17h-2.643 C12.127,17,12,17.374,12,17.774c0,0.721,0.6,4.619,3.875,9.101C18.25,30.125,21.379,32,24.149,32c1.678,0,1.85-0.427,1.85-1.094 v-2.972C26,27.133,26.183,27,26.717,27c0.381,0,1.158,0.25,2.658,2c1.73,2.018,2.044,3,3.036,3h2.618 c0.608,0,0.957-0.255,0.971-0.75c0.003-0.126-0.015-0.267-0.056-0.424c-0.194-0.576-1.084-1.984-2.194-3.326 c-0.615-0.743-1.222-1.479-1.501-1.879C32.062,25.36,31.991,25.176,32,25c0.009-0.185,0.105-0.361,0.249-0.607 C32.223,24.393,35.607,19.642,35.937,18.041z"/>
                        </svg>
                    </a>
                </div>
                <div class="header-right-block">
                    <a href="/">Главная</a>
                </div>
                <div class="header-right-block-auth">
                    <a href="/register">
                        <div class="header-right-block-auth-left">
                            Зарегестрироваться
                        </div>
                    </a>
                    <a href="/login">
                        <div class="header-right-block-auth-right">
                            Войти
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </header>
    @yield('head')
</body>
</html>