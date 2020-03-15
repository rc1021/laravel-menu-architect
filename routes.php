<?php

use Rc1021\LaravelMenuArchitect\Controllers\MenuController;
use Rc1021\LaravelMenuArchitect\Controllers\MenuItemController;

Route::resource('menu_arct', MenuController::class)
    ->except(['show'])
    ->middleware(config('menu_architect.middleware'));

Route::post('menu_arct/{menu_arct}/items/{menu_arct_item}/sort', MenuItemController::class . '@sort')
    ->name('menu_arct_item.sort');
Route::resource('menu_arct/{menu_arct}/items', MenuItemController::class)
    ->except(['show', 'index', 'create', 'edit'])
    ->names([
        'store' => 'menu_arct_item.store',
        'update' => 'menu_arct_item.update',
        'destroy' => 'menu_arct_item.destroy'
    ])
    ->parameters([
        'items' => 'menu_arct_item'
    ])
    ->middleware(config('menu_architect.middleware'));
