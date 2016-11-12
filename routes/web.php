<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'pageTitle' => 'Home',
    ]);
});
Route::group(['prefix' => '/signup/events'], function () {
    Route::get('/', [
        'uses' => 'Signup\SignupController@events',
        'as' => 'signup.events.read',
    ]);
    Route::get('/{eventId}', [
        'uses' => 'Signup\SignupController@event',
        'as' => 'signup.event.read',
    ]);
    Route::get('/{eventId}/update', [
        'uses' => 'Signup\SignupController@update',
        'as' => 'signup.event.update',
    ]);
});
