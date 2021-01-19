<?php

use App\Http\Controllers\QuestionController;
use App\Models\Models\agree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Illuminate\Notifications\HasDatabaseNotifications;

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
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});


Route::apiResource("/question", "App\Http\Controllers\QuestionController");
Route::apiResource("/category", "App\Http\Controllers\CategoryController");
Route::apiResource("/question/{question}/reply", "App\Http\Controllers\ReplyController");
Route::apiResource("/question/{question}/suggestment", "App\Http\Controllers\SuggestmentController");


Route::Post("/like/{reply}", "App\Http\Controllers\LikeController@likeit");
Route::delete("/like/{reply}", "App\Http\Controllers\LikeController@unlikeit");

Route::Post("/agree/{question}", "App\Http\Controllers\AgreeController@agree");
Route::delete("/agree/{question}", "App\Http\Controllers\AgreeController@unagree");
Route::get("/question/{question}/agree", "App\Http\Controllers\AgreeController@index");

Route::Post("/agree/{suggestment_id}", "App\Http\Controllers\AgreeController@agree");
Route::delete("/agree/{agreeName}", "App\Http\Controllers\AgreeController@unagree");
Route::get("/suggestment/{suggestment}/agree", "App\Http\Controllers\agreeController@index");



Route::Post("/disagree/{suggestment_id}", "App\Http\Controllers\DisagreeController@disagree");
Route::delete("/disagree/{disagreeName}", "App\Http\Controllers\DisagreeController@undisagree");
Route::get("/suggestment/{suggestment}/disagree", "App\Http\Controllers\DisagreeController@index");

//Notificationsrout

Route::Post('notifications', "App\Http\Controllers\NotificationController@index");
Route::Post('markAsRead', "App\Http\Controllers\NotificationController@markAsRead");
