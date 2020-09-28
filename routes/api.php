<?php

use App\Http\Controllers\QuestionController;
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

Route::group([

    'prefix' => 'auth',
    'middleware' => 'api',

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});


Route::apiResource("/question", "App\Http\Controllers\QuestionController");
Route::apiResource("/category", "App\Http\Controllers\CategoryController");
Route::apiResource("/question/{question}/reply", "App\Http\Controllers\ReplyController");

Route::Post("/like/{reply}", "App\Http\Controllers\LikeController@likeit");
Route::delete("/like/{reply}", "App\Http\Controllers\LikeController@unlikeit");
