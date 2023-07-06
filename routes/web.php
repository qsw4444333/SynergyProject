<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\UserController@page_user');
Route::post('/', 'App\Http\Controllers\UserController@edit');


Route::get('/register', 'App\Http\Controllers\RegisterController@register_page');
Route::post('/register', 'App\Http\Controllers\RegisterController@register');


Route::get('/login', 'App\Http\Controllers\LoginController@login_page');
Route::post('/login', 'App\Http\Controllers\LoginController@login');


Route::get('/forms', 'App\Http\Controllers\FormController@get');
Route::get('/forms/{form_name}', 'App\Http\Controllers\FormController@get_by_name');
Route::post('/forms/c', 'App\Http\Controllers\FormController@check_name');
Route::post('/forms/d', 'App\Http\Controllers\FormController@delete');
Route::post('/forms', 'App\Http\Controllers\FormController@create');


Route::get('/answers/{form_name}', 'App\Http\Controllers\AnswerController@get');
Route::post('/answers', 'App\Http\Controllers\AnswerController@create');
