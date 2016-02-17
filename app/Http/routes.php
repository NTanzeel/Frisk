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

    Route::group(['as' => 'pages::'], function() {
        Route::get('/', [
            'as'    => 'index',
            'uses'  => 'HomeController@index'
        ]);
    });

    /*
     * Authentication
     */
    Route::auth();

    /*
     * Socialite Authentication
     */

    Route::group(['as' => 'socialite::'], function() {
        Route::get('/auth/{provider}/redirect', [
            'as'    => 'redirect',
            'uses'  =>'SocialiteController@redirect'
        ]);

        Route::get('/auth/{provider}/callback', [
            'as'    => 'redirect',
            'uses'  =>'SocialiteController@callback'
        ]);
    });

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

        Route::delete('dashboard/locations/{id}', [
            'as'    => 'delete',
            'uses'  => 'LocationsController@destroy'
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

        Route::delete('dashboard/items/{id}', [
            'as'    => 'delete',
            'uses'  => 'ItemsController@destroy'
        ]);
    });
});
