<?php

use App\Http\Controllers\UserCardController;
use App\Http\Controllers\UserController;
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


Route::get('sign-in', [UserController::class, 'signIn']);

    Route::post('add-card', [UserCardController::class, 'store']);
    Route::get('get-card', [UserCardController::class, 'index']);