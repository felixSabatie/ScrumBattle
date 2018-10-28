<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['api']], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:api');

    Route::namespace('Api')->group(function() {
        Route::post('register', 'AuthController@register');

        Route::resource('projects', 'ProjectsController')->except(['update', 'show']);
        Route::get('projects/{slug}', 'ProjectsController@show')->middleware('auth:api');
        Route::resource('cards', 'CardsController')->only(['store','update', 'destroy']);
        Route::get('users', 'UsersController@index');
        Route::post('cards/{id}/users', 'CardsController@addUser');
        Route::delete('cards/{cardId}/users/{userId}', 'CardsController@removeUser');
    });
});
