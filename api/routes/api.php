<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\User\UserInformationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/auth')->group(function(){
    Route::post('/register', RegisterController::class. '@index');
    Route::post('/login', LoginController::class. '@index');
});

Route::middleware('auth:api')->group(function(){
    Route::prefix('users')->group(function(){
        Route::get('/me', UserInformationController::class. '@me');
    });
});
