<?php

Route::group(['prefix' => 'admin/categories', 'namespace' => 'CodePress\CodeCategory\Controllers'], function () {

    Route::get('', 'AdminCategoriesController@index');

});