@extends('layouts.main_l')
@section('head')
    <main class="main">
        <div class="main-inner">
            <form action="/register" class="form" method="post">
                @csrf
                <div class="reg-choice">
                    <a style="flex: 0 0 25%;" href="/login">
                        <div class="link-login">
                            Войти
                        </div>
                    </a>
                    <a href="/register" style="flex: 0 0 74%;">
                        <div class="link-register active-link">
                            Зарегестрироваться
                        </div>
                    </a>
                </div>
                <input type="text" id="email" placeholder="Почта" name="email" style="border-radius: 0px;">
                <input type="text" id="surname" placeholder="Фамилия" name="surname" style="border-radius: 0px;">
                <input type="text" id="name" placeholder="Имя" name="name" style="border-radius: 0px;">
                <input type="text" id="secname" placeholder="Отчество" name="secname" style="border-radius: 0px;">
                <div class="pasport-inputs">
                    <label for="#series">Паспортные данные</label>
                    <input type="text" id="series" name="pas_series" placeholder="Серия" maxlength="4" minlength="4" style="border-radius: 0px;">
                    <input type="text" id="number" name="pas_number" placeholder="Номер" maxlength="6" minlength="6" style="border-radius: 0px;">
                </div>
                <input type="submit" value="Зарегестрироваться">
                @if (strlen($form_error) > 0)
                    <span id="form-error" style="text-align: center;width: 100%;display: block;color: #ff5d5d;">{{$form_error}}</span>
                @endif
            </form>
        </div>
    </main>
@endsection