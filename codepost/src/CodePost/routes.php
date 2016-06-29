<?php

Route::group([
    'prefix' => 'admin/posts',
    'as' => 'admin.posts.',
    'namespace' => 'CodePress\CodePost\Controllers',
    'middleware' => ['web', 'auth']
], function () {

    Route::get('/', ['uses' => 'AdminPostsController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'AdminPostsController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'AdminPostsController@store', 'as' => 'store']);
    Route::get('/edit/{id}', ['uses' => 'AdminPostsController@edit', 'as' => 'edit']);
    Route::post('/update/{id}', ['uses' => 'AdminPostsController@update', 'as' => 'update']);
    Route::get('/destroy/{id}', ['uses' => 'AdminPostsController@destroy', 'as' => 'destroy']);
    Route::get('/deleted', ['uses' => 'AdminPostsController@deleted', 'as' => 'deleted']);

});
