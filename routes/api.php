<?php

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

Route::middleware('auth:api')->group(function () {

    Route::get('/posts', 'PostsController@index');
    Route::post('/posts', 'PostsController@store');
    Route::get('/posts/{post}', 'PostsController@show');
    Route::patch('/posts/{post}', 'PostsController@update');
    Route::delete('/posts/{post}', 'PostsController@destroy');
    Route::get('/profiles', 'ProfilesController@index');
    Route::get('/profiles/{profile}', 'ProfilesController@show');
    Route::post('/follow/{user}', 'FollowsController@store');
});
