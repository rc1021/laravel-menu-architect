<?php

namespace Rc1021\LaravelMenuArchitect\Facades;

use Illuminate\Support\Facades\Facade;

class MenuArct extends Facade
{
    /**
     * @see \Rc1021\LaravelMenuArchitect\MenuArct
     */
    protected static function getFacadeAccessor() : string
    {
        return 'menu_arct';
    }
}
