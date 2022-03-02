<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('dynamic-form', function () {
    return view('dynamic-form');
});

Route::get('public-form', function () {
    return view('public-form');
});

Route::get('mail', function () {
    $form_data = App\Models\FormData::latest()->first();
        return new App\Mail\FormSubmitSendMail($form_data);
    return view('mails.form-submit');
});