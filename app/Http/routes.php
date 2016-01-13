<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    /*
     * Root
     */
    Route::get('/', function() {
        return view('welcome');
    });

    Route::get('/home', 'HomeController@index');

    /*
     * Authentication
     */
    Route::auth();

    /*
     * Socialite Authentication
     */
    Route::get('auth/{provider}/redirect', 'SocialiteController@redirect');
    Route::get('auth/{provider}/callback', 'SocialiteController@callback');
});
