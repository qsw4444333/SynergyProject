<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\User;

function gen_password($len){
    $password = '';
    $alph = 'qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
    for ($i = 0; $i < $len; $i++){
        $password .= $alph[random_int(0, strlen($alph) - 1)];
    }
    return $password;
}
class RegisterController extends Controller
{

    public function register(UserRequest $request){
        session_start();
        $data = $request->validated();

        $data['password'] = gen_password(8);

        $person = $data;
        $person['password'] = password_hash($person['password'], PASSWORD_DEFAULT);
        $person['passed_forms'] = '';

        if (count(Person::where('email', $data['email'])->get()) > 0){
            $title = 'Регистрация';
            $form_error = 'Этот email уже кем-то занят';
            return view('reg', ["title" => $title, "form_error" => $form_error]);
        }

        else if(count(Person::where('pas_number', $data['pas_number'])->get()) > 0 &&
                count(Person::where('pas_series', $data['pas_series'])->get()) > 0){
                $title = 'Регистрация';
                $form_error = 'Эти паспортные данные уже кто-то использует';
                return view('reg', ["title" => $title, "form_error" => $form_error]);
        }

        else{
            $_SESSION['is_auth'] = true;
            $_SESSION['uEmail'] = $data['email'];
            $_SESSION['uPassword'] = $data['password'];
            Person::create($person);
            return redirect('/');
        }

    }

    public function register_page(){
        $title = 'Регистрация';
        return view('reg', ["title" => $title, "form_error" => '']);
    }

}
