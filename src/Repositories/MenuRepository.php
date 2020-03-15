<?php

namespace Rc1021\LaravelMenuArchitect\Repositories;

use DB;
use Illuminate\Http\Request;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitect;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitectItem;

class MenuRepository
{
    public function getIndexViewModel()
    {
        return (object)[
            'items' => MenuArchitect::all()
        ]; 
    }

    public function getCreateViewModel()
    {
        
    }

    public function store($input)
    {
        return MenuArchitect::create($input);
    }

    public function getEditViewModel($id)
    {
        return (object)[
            'data' => MenuArchitect::findOrFail($id)
        ];
    }

    public function update($input, $id)
    {
        $collection = collect($input);
        $filtered = $collection->only(['name']);

        $menu = MenuArchitect::findOrFail($id);
        $menu->fill($filtered->toArray());
        $menu->save();
    }

    public function destroy($id)
    {
        $menu = MenuArchitect::findOrFail($id);
        DB::transaction(function () use ($menu) {
            DB::table((new MenuArchitectItem)->getTable())->where('menu_id', $menu->id)->delete();
            DB::table($menu->getTable())->where('id', $menu->id)->delete();
        });
    }

}