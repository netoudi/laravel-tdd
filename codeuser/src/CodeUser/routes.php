<?php

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'CodePress\CodeUser\Controllers',
    'middleware' => ['web', 'auth']
], function () {

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', ['uses' => 'Admin\UsersController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'Admin\UsersController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'Admin\UsersController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'Admin\UsersController@edit', 'as' => 'edit']);
        Route::post('/update/{id}', ['uses' => 'Admin\UsersController@update', 'as' => 'update']);
        Route::get('/destroy/{id}', ['uses' => 'Admin\UsersController@destroy', 'as' => 'destroy']);
    });

    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/', ['uses' => 'Admin\RolesController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'Admin\RolesController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'Admin\RolesController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'Admin\RolesController@edit', 'as' => 'edit']);
        Route::post('/update/{id}', ['uses' => 'Admin\RolesController@update', 'as' => 'update']);
        Route::get('/destroy/{id}', ['uses' => 'Admin\RolesController@destroy', 'as' => 'destroy']);
    });

    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::get('/', ['uses' => 'Admin\PermissionsController@index', 'as' => 'index']);
        Route::get('/view/{id}', ['uses' => 'Admin\PermissionsController@view', 'as' => 'view']);
    });

});
