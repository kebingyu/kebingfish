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

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home',
]);

Route::group(['prefix' => '/signup/events'], function () {
    Route::get('/', [
        'uses' => 'Signup\SignupController@events',
        'as' => 'signup.events.read',
    ]);
    Route::get('/create', [
        'uses' => 'Signup\SignupController@eventCreate',
        'as' => 'signup.event.create',
    ]);
    Route::get('/{eventId}', [
        'uses' => 'Signup\SignupController@eventShow',
        'as' => 'signup.event.read',
    ]);
    Route::get('/{eventId}/update', [
        'uses' => 'Signup\SignupController@eventUpdate',
        'as' => 'signup.event.update',
    ]);
    Route::get('/{eventId}/print', [
        'uses' => 'Signup\SignupController@eventPrint',
        'as' => 'signup.event.print',
    ]);
});
