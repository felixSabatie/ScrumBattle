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
    });

    Route::namespace('Api')->group(function() {
        Route::resource('projects', 'ProjectsController')->except(['create', 'update', 'show']);
        Route::get('projects/{slug}', 'ProjectsController@show');
        Route::resource('cards', 'CardsController');
    });
});
