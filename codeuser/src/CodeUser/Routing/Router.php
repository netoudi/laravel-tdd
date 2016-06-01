<?php

namespace CodePress\CodeUser\Routing;

use Illuminate\Support\Facades\Route;

class Router
{
    public function auth()
    {
        $namespace = "\\CodePress\\CodeUser\\Controllers";

        Route::group([
            'namespace' => null
        ], function () use ($namespace) {
            Route::get('login', "$namespace\\Auth\\AuthController@showLoginForm");
            Route::post('login', "$namespace\\Auth\\AuthController@login");
            Route::get('logout', "$namespace\\Auth\\AuthController@logout");

            Route::get('password/reset/{token?}', "$namespace\\Auth\\PasswordController@showResetForm");
            Route::post('password/email', "$namespace\\Auth\\PasswordController@sendResetLinkEmail");
            Route::post('password/reset', "$namespace\\Auth\\PasswordController@reset");
        });
    }
}