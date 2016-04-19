<?php

Route::group(['prefix' => 'admin/users', 'as' => 'admin.users.', 'namespace' => 'CodePress\CodeUser\Controllers', 'middleware' => ['web']], function () {

    Route::get('/', ['uses' => 'Admin\UsersController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'Admin\UsersController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'Admin\UsersController@store', 'as' => 'store']);
    Route::get('/edit/{id}', ['uses' => 'Admin\UsersController@edit', 'as' => 'edit']);
    Route::post('/update/{id}', ['uses' => 'Admin\UsersController@update', 'as' => 'update']);
    Route::get('/destroy/{id}', ['uses' => 'Admin\UsersController@destroy', 'as' => 'destroy']);

});