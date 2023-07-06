<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{

    public function login(UserRequest $request){
        session_start();
        $data = $request->validated();
        $pas_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        if (count(Person::where('email', $data['email'])->get()) == 0){
            $title = 'Авторизация';
            $form_error = 'Этот email не зарегестрирован';
            return view('login', ["title" => $title, "form_error" => $form_error]);
        }

        else{
            if (password_verify($data["password"], Person::where('email', $data['email'])->get('password')[0]->password)){
                $user = Person::where('email', $data['email'])->get();
                $_SESSION['is_auth'] = true;
                $_SESSION['uEmail'] = $data['email'];
                $_SESSION['uPassword'] = $data['password'];

                return redirect('/');
            }
            else{
                $title = 'Авторизация';
                $form_error = 'Неверный пароль';
                return view('login', ["title" => $title, "form_error" => $form_error]);
            }
        }

    }
    public function login_page(){
        $title = 'Авторизация';
        $form_error = '';
        return view('login', ["title" => $title, "form_error" => $form_error]);
    }
}
