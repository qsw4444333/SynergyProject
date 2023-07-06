@extends('layouts.main_l')
@section('head')
    <main class="main">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="main-inner">
            <div class="main-left">
                <div class="amount-tests">
                    <span>Вы прошли 1 из 3 анкет</span>
                </div>
                <div class="main-left-inner">
                    @for ($i = 0; $i < $forms['amounts']; $i++)
                        <div class="main-left-block" id="questionnaire-1">
                            <p>{{ $forms['forms'][$i]['name'] }}</p>
                            @if (in_array($forms['forms'][$i]['id'],  $forms['passeds']))
                                <div class="main-left-block-indicator passed"></div>
                            @else
                                <div class="main-left-block-indicator not-passed"></div>
                            @endif
                        </div>
                    @endfor
                    <div class="main-left-block-create">
                        <p>Создать форму</p>
                    </div>
                </div>
            </div>
            <div class="main-right">
                <div class="main-right-inner">
                    <div class="main-right-inner-left">
                        <h4>Контактная информация</h4>
                        <div class="contact-block">
                            <span>Фамилия:</span>
                            <p>{{ $user['surname'] }}</p>
                        </div>
                        <div class="contact-block">
                            <span>Имя:</span>
                            <p>{{ $user['name'] }}</p>
                        </div>
                        <div class="contact-block">
                            <span>Отчество:</span>
                            <p>{{ $user['secname'] }}</p>
                        </div>
                        <div class="contact-block">
                            <span>Серия паспорта:</span>
                            <p>{{ $user['pas_series'] }}</p>
                        </div>
                        <div class="contact-block">
                            <span>Номер паспорта:</span>
                            <p>{{ $user['pas_number'] }}</p>
                        </div>
                        <div class="ctontact-block-edit">
                            <span>Изменить</span>
                        </div>
                    </div>
                    <div class="main-right-inner-right">
                        <h4>Данные аккаунта</h4>
                        <div class="main-right-inner-right-block">
                            <span>Почта:</span>
                            <p>{{ $user['email'] }}</p>
                        </div>
                        <div class="main-right-inner-right-block">
                            <span>Пароль:</span>
                            <p id="show_pass">Показать</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="black-block"></div>

        <div class="pass-modal-show">
            <div class="pass-modal-show-inner">
                <div class="modal-close close-pass-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
                <div class="modal-name">
                    <h4>Ваш пароль</h4>
                </div>
                <div class="pass">
                    <span>{{ $user['password2'] }}</span>
                </div>
            </div>
        </div>
        <div class="create-questionnaire-modal">
            <div class="create-questionnaire-modal-inner">
                <div class="modal-close close-create-questionnaire">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
                <div class="modal-name">
                    <h4>Создание анкеты</h4>
                </div>
                <div class="modal-create-questionnaire">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#f00" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                    <p>Добавить поле</p>
                </div>
                <div class="modal-create-name">
                    <input id="questionnaire-name" type="text" placeholder="Название анкеты" maxlength="10">
                    <span id="questionnaire-error-name"></span>
                </div>
                <div class="modal-create-body">
                    <div class="modal-create-nav">
                        <div class="modal-create-nav-block">
                            <div class="modal-create-nav-block-t">
                                <p>Ваши поля</p>
                            </div>
                            <div class="modal-create-nav-block-e">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-create-blocks">   
                        <div class="modal-create-block" id="create-block-1">
                            <div class="modal-create-block-hide">
                                <span>Вопрос1</span>
                                <div class="input"></div>
                                <div class="block-num">1</div>
                            </div>
                            <div class="modal-create-block-show">
                                <div class="create-block-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                                <div class="create-block-save">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" fill="#fff" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                    </svg>
                                </div>
                                <div class="create-block-save-body">
                                    <input type="text" placeholder="Название поля">
                                </div>
                            </div>
                        </div>
                        <div class="modal-create-block" id="create-block-2">
                            <div class="modal-create-block-hide">
                                <span>Вопрос2</span>
                                <div class="input"></div>
                                <div class="block-num">2</div>
                            </div>
                            <div class="modal-create-block-show">
                                <div class="create-block-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                                <div class="create-block-save">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" fill="#fff" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                    </svg>
                                </div>
                                <div class="create-block-save-body">
                                    <input type="text" placeholder="Название поля">
                                </div>
                            </div>
                        </div>
                        <div class="modal-create-block" id="create-block-3">
                            <div class="modal-create-block-hide">
                                <span>Вопрос3</span>
                                <div class="input"></div>
                                <div class="block-num">3</div>
                            </div>
                            <div class="modal-create-block-show">
                                <div class="create-block-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                                <div class="create-block-save">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" fill="#fff" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                    </svg>
                                </div>
                                <div class="create-block-save-body">
                                    <input type="text" placeholder="Название поля">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-create-save">
                    <span>Сохранить</span>
                </div>
            </div>
        </div>
        <div class="edit-profile-modal">
            <div class="edit-profile-modal-inner">
                <div class="modal-close edit-profile-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
                <div class="modal-name">
                    <h4>Редактирование профиля</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-block">
                        <span>Фамилия</span>
                        <input type="text" placeholder="Фамилия" id="sec-name" minlength="0" maxlength="20" value="{{ $user['surname'] }}">
                    </div>
                    <div class="modal-block">
                        <span>Имя</span>
                        <input type="text" placeholder="Имя" id="name" minlength="0" maxlength="20" value="{{ $user['name'] }}">
                    </div>
                    <div class="modal-block">
                        <span>Отчество</span>
                        <input type="text" placeholder="Отчество" id="surname" minlength="0" maxlength="20" value="{{ $user['secname'] }}">
                    </div>
                    <div class="modal-block">
                        <span>Серия</span>
                        <input type="text" placeholder="Серия паспорта" id="ser-p" maxlength="4" minlength="0" value="{{ $user['pas_series'] }}">
                    </div>
                    <div class="modal-block">
                        <span>Номер</span>
                        <input type="text" placeholder="Номер паспорта" id="num-p" maxlength="6" minlength="0" value="{{ $user['pas_number'] }}">
                    </div>
                    <div class="modal-block">
                        <span>Почта</span>
                        <input type="text" placeholder="Почта" id="email" maxlength="30" minlength="0" value="{{ $user['email'] }}">
                    </div>
                    <div class="modal-block">
                        <span>Пароль</span>
                        <input type="text" placeholder="Пароль" id="pass" maxlength="16" minlength="8" value="{{ $user['password2'] }}">
                    </div>
                    <div class="modal-block-save">
                        <span>Сохранить</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="edit-que-modal">
            <div class="modal-close edit-que-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
            <div class="edit-que-modal-inner">
                <div class="modal-name" style="flex: 0 0 100%;">
                    <h4>Редактирование профиля</h4>
                </div>
                <div class="e-que-btn" id="e-que-btn-g">
                    <span>Пройти</span>
                </div>
                <div class="e-que-btn" id="e-que-btn-d">
                    <span>Удалить</span>
                </div>
            </div>
        </div>
        <div class="pass-que-modal">
            <div class="modal-close pass-que-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
            <div class="modal-name">
                <h4>Редактирование профиля</h4>
            </div>
            <div class="pass-que-modal-inner">
                <input type="submit" id="pass-subm" value="Отправить">
            </div>
        </div>
    </main>
    <script src="{{ URL::asset('js/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ URL::asset('js/global.js') }}"></script>

@endsection
