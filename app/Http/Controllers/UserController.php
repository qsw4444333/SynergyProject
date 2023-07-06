<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Form;

class UserController extends Controller
{

    public function page_user(){
        session_start();
        $title = 'Главная';
        if (array_key_exists('is_auth', $_SESSION) && array_key_exists('uEmail', $_SESSION) && array_key_exists('uPassword', $_SESSION)){
            
            if ($_SESSION['is_auth'] === true){

                $user = Person::where('email', $_SESSION['uEmail'])->get();
                if (count($user) > 0){

                    if (password_verify($_SESSION["uPassword"], $user[0]["password"])){
                        $id = Person::where('email', $_SESSION['uEmail'])->get()[0]->id;
                        $user[0]['password2'] = $_SESSION["uPassword"];
                        $forms = Form::where('author', $id)->get();
                        $passeds = Person::where('email', $_SESSION['uEmail'])->get('passed_forms')[0]['passed_forms'];
                        $forms_list = ['amounts' => count($forms),
                                       'forms' => $forms,
                                       'passeds' => array_map('intval', explode(' ', $passeds))];
                        return view('home', ["title" => $title, "user" => $user[0], "forms" => $forms_list]);

                    }
                    else{
                        return redirect(('/login'));
                    }
                }
                else{
                    return redirect(('/login'));
                }
            }
            else{
                return redirect(('/login'));
            }
        }
        else{
            return redirect(('/login'));
        }
    }

    public function edit(UserRequest $request){
        session_start();
        if (!array_key_exists('uEmail', $_SESSION) ||
            !array_key_exists('uPassword', $_SESSION) ||
            !array_key_exists('is_auth', $_SESSION)){
                header('Content-type: application/json');
                return json_encode(['status' => 'Invalid session data']);
        }

        if ($_SESSION['is_auth'] !== true){
            header('Content-type: application/json');
            return json_encode(['status' => 'Invalid session data']);
        }

        if (!password_verify($_SESSION['uPassword'], Person::where('email', $_SESSION['uEmail'])->get('password')[0]->password)){
            header('Content-type: application/json');
            return json_encode(['status' => 'Invalid session data']);
        }

        $person = json_decode($request->getContent(), true);
        $pass = $person['password'];
        $person['password'] = password_hash($person['password'], PASSWORD_DEFAULT);

        Person::where('email', $_SESSION['uEmail'])->update($person);

        $_SESSION['uEmail'] = $person['email'];
        $_SESSION['uPassword'] = $pass;

        
        header('Content-type: application/json');
        return json_encode(['status' => 'success']);
    }

}
