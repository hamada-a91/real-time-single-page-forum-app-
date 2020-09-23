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


Route::apiResource("/question", "App\Http\Controllers\QuestionController");
Route::apiResource("/category", "App\Http\Controllers\CategoryController");
Route::apiResource("/question/{question}/reply", "App\Http\Controllers\ReplyController");

Route::Post("/like/{reply}", "App\Http\Controllers\LikeController@likeit");
Route::delete("/like/{reply}", "App\Http\Controllers\LikeController@unlikeit");
