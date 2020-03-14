<?php

if (!function_exists('menu_arct')) {
    function menu_arct($menuNameOrID, $type = null, array $options = [])
    {
        return Rc1021\LaravelMenuArchitect\Facades\MenuArct::model($menuNameOrID, $type, $options);
    }
}