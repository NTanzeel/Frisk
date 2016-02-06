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
    Route::get('/auth/{provider}/redirect', 'SocialiteController@redirect');
    Route::get('/auth/{provider}/callback', 'SocialiteController@callback');

    /*
     * Dashboard
     */
    Route::group(['as' => 'dashboard::'], function() {
        Route::get('/dashboard', [
            'as'    => 'index',
            'uses'  => 'DashboardController@index'
        ]);
    });

    /*
     * Items
     */

    Route::group(['as' => 'items::'], function() {
        Route::get('/dashboard/items', [
            'as'    => 'index',
            'uses'  => 'ItemsController@index'
        ]);

        Route::get('/dashboard/items/create', [
            'as'    => 'create',
            'uses'  => 'ItemsController@create'
        ]);

        Route::post('/dashboard/items/create', [
            'as'    => 'store',
            'uses'  => 'ItemsController@store'
        ]);
    });

    /*
     * Locations
     */
    Route::group(['as' => 'locations::'], function() {
        Route::get('/dashboard/locations', [
            'as'    => 'index',
            'uses'  => 'LocationsController@index'
        ]);

        Route::get('/dashboard/locations/create', [
            'as'    => 'create',
            'uses'  => 'LocationsController@create'
        ]);

        Route::post('/dashboard/locations/create', [
            'as'    => 'store',
            'uses'  => 'LocationsController@store'
        ]);
    });
});
