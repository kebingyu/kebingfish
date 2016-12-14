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

Route::group(['prefix' => '/signup.events'], function () {
    // Events
    Route::get('/', [
        'uses' => 'Signup\EventController@events',
        'as' => 'api.signup.events.read',
    ]);
    Route::get('/{event}', [
        'uses' => 'Signup\EventController@event',
        'as' => 'api.signup.event.read',
    ]);
    Route::patch('/{event}', [
        'uses' => 'Signup\EventController@update',
        'as' => 'api.signup.event.update',
    ]);
    Route::post('/{event}/reset', [
        'uses' => 'Signup\EventController@reset',
        'as' => 'api.signup.event.reset',
    ]);
    Route::post('/', [
        'uses' => 'Signup\EventController@add',
        'as' => 'api.signup.events.create',
    ]);
    Route::delete('/{event}', [
        'uses' => 'Signup\EventController@delete',
        'as' => 'api.signup.event.delete',
        'middleware' => 'auth',
    ]);
    // Users
    Route::post('/{event}/users', [
        'uses' => 'Signup\EventUserController@add',
        'as' => 'api.signup.event.user.create',
    ]);
    Route::delete('/{event}/users/{eventUser}', [
        'uses' => 'Signup\EventUserController@delete',
        'as' => 'api.signup.event.user.delete',
    ]);
});

Route::group(['prefix' => '/signup.locations'], function () {
    Route::get('/', [
        'uses' => 'Signup\LocationController@locations',
        'as' => 'api.signup.locations.read',
    ]);
    Route::get('/{location}', [
        'uses' => 'Signup\LocationController@location',
        'as' => 'api.signup.location.read',
    ]);
});
