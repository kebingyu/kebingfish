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
        'middleware' => 'auth',
    ]);
    Route::get('/{event}', [
        'uses' => 'Signup\SignupController@eventShow',
        'as' => 'signup.event.read',
    ]);
    Route::get('/{event}/update', [
        'uses' => 'Signup\SignupController@eventUpdate',
        'as' => 'signup.event.update',
        'middleware' => 'auth',
    ]);
    Route::get('/{event}/print', [
        'uses' => 'Signup\SignupController@eventPrint',
        'as' => 'signup.event.print',
    ]);
});

Route::group(['prefix' => '/signup/locations'], function () {
    Route::get('/', [
        'uses' => 'Signup\SignupLocationController@locations',
        'as' => 'signup.locations.read',
    ]);
    Route::get('/{location}', [
        'uses' => 'Signup\SignupLocationController@location',
        'as' => 'signup.location.read',
    ]);
});

Route::get('/signup/login', [
    'uses' => 'Signup\SignupAdminController@showLoginForm',
    'as' => 'signup.admin.login.form',
]);
Route::post('/signup/login', [
    'uses' => 'Signup\SignupAdminController@login',
    'as' => 'signup.admin.login',
]);
Route::post('/signup/logout', [
    'uses' => 'Signup\SignupAdminController@logout',
    'as' => 'signup.admin.logout',
]);
