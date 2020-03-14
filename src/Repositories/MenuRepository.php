<?php

namespace Rc1021\LaravelMenuArchitect\Repositories;

use Illuminate\Http\Request;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitect;

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
        
    }

    public function destroy($id)
    {
        
    }

}