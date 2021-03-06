<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [LoginController::class, 'loggedOut']);
    Route::post('form', [FormController::class, 'store']);
    Route::post('form-store', [FormController::class, 'formDataStore']);
    Route::get('public-form', [FormController::class, 'index']);
});

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [LoginController::class, 'register']);