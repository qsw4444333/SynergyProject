<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Form;
use App\Http\Requests\FormIndRequest;

class FormController extends Controller
{

    public function handler(){

    }

    public function get(){
        session_start();
        if (array_key_exists('uEmail', $_SESSION)){
            $id = Person::where('email', $_SESSION['uEmail'])->get()[0]->id;
            $form = Form::where('author', $id)->get();
            header('Content-type: application/json');
            return json_encode($form);
        }
        else{
            header('Content-type: application/json');
            return json_encode(['status' => 'error', 'cause' => 'Invalid email in session']);
        }
    }

    public function check_name(Request $request){
        session_start();

        $check_name = json_decode($request->getContent(), true)['name'];
        $id = Person::where('email', $_SESSION['uEmail'])->get()[0]->id;
        if (count(Form::where('author', $id)->where('name', $check_name)->get()->toArray()) > 0){
            header('Content-type: application/json');
            return json_encode(['is' => true]);
        }
        else{
            header('Content-type: application/json');
            return json_encode(['is' => false]);
        }

    }

    public function get_by_name($form_name){
        session_start();
        if (array_key_exists('uEmail', $_SESSION)){
            $id = Person::where('email', $_SESSION['uEmail'])->get()[0]->id;
            $form = Form::where('author', $id)->where('name', $form_name)->first();
            header('Content-type: application/json');
            return json_encode($form);
        }
        else{
            header('Content-type: application/json');
            return json_encode(['status' => 'error', 'cause' => 'Invalid email in session']);
        }
    }

    public function delete(Request $request){
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

        $form_name = json_decode($request->getContent(), true)['name'];
        $id = Person::where('email', $_SESSION['uEmail'])->get()[0]->id;
        $form = Form::where('author', $id)->get();
        if ($form !== null){
            $form = Form::where('author', $id)->where('name', $form_name)->get();
            if ($form !== null){
                Form::where('author', $id)->where('name', $form_name)->delete();
                header('Content-type: application/json');
                return json_encode(['status' => 'success']);
            }
        }
        header('Content-type: application/json');
        return json_encode(['status' => 'error', 'cause' => 'Unknown form name or email in session']);
    }

    public function create(FormIndRequest $request){
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

        if(count(Person::where('email', $_SESSION['uEmail'])->get()->toArray()) == 0){
            header('Content-type: application/json');
            return json_encode(['status' => 'Invalid session data']);
        }

        $form = json_decode($request->getContent(), true);
        $form['author'] = Person::where('email', $_SESSION['uEmail'])->get()[0]->id;
        Form::create($form);
        header('Content-type: application/json');
        return json_encode(['status' => 'success']);
    }
}
