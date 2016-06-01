<?php

namespace CodePress\CodeUser\Facade;

use Illuminate\Support\Facades\Facade;

class Route extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'codepress_user_route';
    }
}