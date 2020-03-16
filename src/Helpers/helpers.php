<?php

if (!function_exists('menu_arct')) {
    function menu_arct($menuName, $type = null, array $options = [])
    {
        return Rc1021\LaravelMenuArchitect\Facades\MenuArct::model('MenuArchitect')->output($menuName, $type, $options);
    }
}