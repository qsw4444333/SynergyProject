<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Form;
use App\Models\Answer;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{

    public function get(AnswerRequest $request, $form_name){
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

        $user_id = Person::where('email', $_SESSION['uEmail'])->get('id')[0]->id;
        if (count(Form::where('author', $user_id)->get()[0]->toArray()) == 0){
            header('Content-type: application/json');
            return json_encode(['status' => 'Form with your email not found']);
        }

        $form_id = Form::where('author', $user_id)->where('name', $form_name)->get('id')[0]->id;
        $answer = Answer::where('user_id', $user_id)->where('form_id', $form_id)->get()[0];
        header('Content-type: application/json');
        return json_encode($answer);

    }

    public function create(AnswerRequest $request){
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

        $answer = json_decode($request->getContent(), true);

        $answer['user_id'] = Person::where('email', $_SESSION['uEmail'])->get()[0]->id;
        if (Form::where('name', $answer['form_name'])->first() !== null){

            $answer['form_id'] = Form::where('name', $answer['form_name'])->get()[0]->id;
            
            $my_passed_forms = Person::where('email', $_SESSION['uEmail'])->get()[0]->passed_forms;

            if (strlen($my_passed_forms) > 0){
                $my_passed_forms .= " {$answer['form_id']}";
            }
            else{
                $my_passed_forms = "{$answer['form_id']}";
            }

            Answer::create($answer);

            $person = Person::where('email', $_SESSION['uEmail'])->get();
            $person = $person->toArray()[0];

            $person['passed_forms'] = $my_passed_forms;

            unset($person['updated_at']);
            unset($person['created_at']);

            Person::where('email', $_SESSION['uEmail'])->update($person);

            header('Content-type: application/json');
            return json_encode(['status' => 'success']);
        }
            
        else{
            header('Content-type: application/json');
            return json_encode(['status' => 'error', 'cause' => 'Invalid form name']);

        }

    }
}
