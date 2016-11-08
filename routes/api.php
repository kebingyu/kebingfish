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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => '/signup.events'], function () {
    // Events
    Route::get('/', [
        'uses' => 'Signup\EventController@events',
        'as' => 'signup.events.all',
    ]);
    Route::get('/{event}', [
        'uses' => 'Signup\EventController@event',
        'as' => 'signup.event.read',
    ]);
    Route::post('/', [
        'uses' => 'Signup\EventController@add',
        'as' => 'signup.events.add',
    ]);
    Route::delete('/{event}', [
        'uses' => 'Signup\EventController@delete',
        'as' => 'signup.event.delete',
    ]);
    // Users
    Route::post('/{event}/users', [
        'uses' => 'Signup\EventUserController@add',
        'as' => 'signup.event.user.add',
    ]);
    /*
    Route::delete('/{event}/users/{eventUser}', function ($event, $user) {
        dd($event, $user);
    });
     */
    Route::delete('/{event}/users/{eventUser}', [
        'uses' => 'Signup\EventUserController@delete',
        'as' => 'signup.event.user.delete',
    ]);
});
