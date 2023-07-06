@extends('layouts.main_l')
@section('head')
    <main class="main">
        <div class="main-inner">
            <form action="/login" class="form" method="post">
                @csrf
                <div class="reg-choice">
                    <a style="flex: 0 0 25%;" href="/login">
                        <div class="link-login active-link">
                            Войти
                        </div>
                    </a>
                    <a href="/register" style="flex: 0 0 74%;">
                        <div class="link-register">
                            Зарегистрироваться
                        </div>
                    </a>
                </div>
                <input type="text" id="email" placeholder="Почта" name="email" style="border-radius: 0px;">
                <input type="password" placeholder="Пароль" name="password" style="border-radius: 0px;">
                <input type="submit" value="Войти">
                @if (strlen($form_error) > 0)
                    <span id="form-error" style="text-align: center;width: 100%;display: block;color: #ff5d5d;">{{$form_error}}</span>
                @endif
            </form>
        </div>
    </main>
@endsection