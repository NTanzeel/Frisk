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
            'uses'  => 'PagesController@index'
        ]);
    });

    Route::group(['as' => 'search::'], function() {
        Route::get('search/', [
            'as'    => 'index',
            'uses'  => 'SearchController@index'
        ]);

        Route::get('search/near/{latitude}/{longitude}', [
            'as'    => 'near',
            'uses'  => 'SearchController@near'
        ]);


        Route::get('items/{id}', [
            'as'    => 'view',
            'uses'  => 'SearchController@show'
        ]);
    });

    /*
     * Authentication
     */
    Route::group(['as' => 'auth::'], function() {
        /*
         * Login Routes
         */
        Route::get('login', [
            'as'    => 'login',
            'uses'  => 'Auth\AuthController@showLoginForm'
        ]);

        Route::post('login', [
            'as'    => 'attempt',
            'uses'  => 'Auth\AuthController@login'
        ]);

        /*
         * Logout Routes
         */
        Route::get('logout', [
            'as'    => 'logout',
            'uses'  => 'Auth\AuthController@signout'
        ]);

        /*
         * Registration Routes
         */
        Route::get('register', [
            'as'    => 'register',
            'uses'  => 'Auth\AuthController@showRegistrationForm'
        ]);

        Route::post('register', [
            'as'    => 'store',
            'uses'  => 'Auth\AuthController@register'
        ]);

        /*
         * Password Reset Routes
         */
        Route::get('password/reset/{token?}', [
            'as'    => 'reset',
            'uses'  => 'Auth\PasswordController@showResetForm'
        ]);

        Route::post('password/email', [
            'as'    => 'email',
            'uses'  => 'Auth\PasswordController@sendResetLinkEmail'
        ]);

        Route::post('password/reset', [
            'as'    => 'update',
            'uses'  => 'Auth\PasswordController@reset'
        ]);
    });

    /*
     * Socialite Authentication
     */

    Route::group(['as' => 'socialite::'], function() {
        Route::get('auth/{provider}/redirect', [
            'as'    => 'redirect',
            'uses'  =>'SocialiteController@redirect'
        ]);

        Route::get('auth/{provider}/callback', [
            'as'    => 'redirect',
            'uses'  =>'SocialiteController@callback'
        ]);
    });

    /*
     * Dashboard
     */
    Route::group(['as' => 'dashboard::'], function() {
        Route::get('dashboard', [
            'as'    => 'index',
            'uses'  => 'DashboardController@index'
        ]);
    });

    /*
     * Locations
     */
    Route::group(['as' => 'locations::'], function() {
        Route::get('dashboard/locations', [
            'as'    => 'index',
            'uses'  => 'LocationsController@index'
        ]);

        Route::get('dashboard/locations/create', [
            'as'    => 'create',
            'uses'  => 'LocationsController@create'
        ]);

        Route::post('dashboard/locations/create', [
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
        Route::get('dashboard/items', [
            'as'    => 'index',
            'uses'  => 'ItemsController@index'
        ]);

        Route::get('dashboard/items/create', [
            'as'    => 'create',
            'uses'  => 'ItemsController@create'
        ]);

        Route::post('dashboard/items', [
            'as'    => 'store',
            'uses'  => 'ItemsController@store'
        ]);

        Route::get('dashboard/items/{id}/edit', [
            'as'    => 'edit',
            'uses'  => 'ItemsController@edit'
        ]);

        Route::put('dashboard/items/{id}', [
            'as'    => 'save',
            'uses'  => 'ItemsController@update'
        ]);

        Route::post('dashboard/items/{id}/toggle', [
            'as'    => 'toggle',
            'uses'  => 'ItemsController@toggleStolen'
        ]);

        Route::delete('dashboard/items/{id}', [
            'as'    => 'delete',
            'uses'  => 'ItemsController@destroy'
        ]);

        Route::get('dashboard/items/{id}/delete', [
            'as'    => 'remove',
            'uses'  => 'ItemsController@destroy'
        ]);
    });

    Route::group(['as' => 'resources::', 'middleware' => 'ajax'], function() {
        Route::get('dashboard/resources/create', [
            'as'    => 'create',
            'uses'  => 'ResourcesController@create'
        ]);

        Route::post('dashboard/resources', [
            'as'    => 'store',
            'uses'  => 'ResourcesController@store'
        ]);

        Route::get('dashboard/resources/{id}/edit', [
            'as'    => 'edit',
            'uses'  => 'ResourcesController@edit'
        ]);

        Route::put('dashboard/resources/{id}', [
            'as'    => 'save',
            'uses'  => 'ResourcesController@update'
        ]);

        Route::delete('dashboard/resources/{id}', [
            'as'    => 'delete',
            'uses'  => 'ResourcesController@destroy'
        ]);
    });

    Route::group(['as' => 'messages::'], function() {
        Route::get('dashboard/messages', [
            'as'    => 'index',
            'uses'  => 'MessagesController@index'
        ]);

        Route::get('dashboard/messages/{id}', [
            'as'    => 'view',
            'uses'  => 'MessagesController@show'
        ]);

        Route::get('dashboard/messages/{id}/create', [
            'as'    => 'create',
            'uses'  => 'MessagesController@create'
        ]);

        Route::post('dashboard/messages/{id}/create', [
            'as'    => 'store',
            'uses'  => 'MessagesController@store'
        ]);

        Route::get('dashboard/messages/{id}/reply', [
            'as'    => 'reply',
            'uses'  => 'MessagesController@reply'
        ]);

        Route::post('dashboard/messages/{id}/reply', [
            'as'    => 'update',
            'uses'  => 'MessagesController@update'
        ]);

        Route::delete('dashboard/messages/{id}', [
            'as'    => 'delete',
            'uses'  => 'MessagesController@destroy'
        ]);
    });
});
