<?php 

namespace Rc1021\LaravelMenuArchitect;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitect;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitectItem;

class MenuArct
{
    protected $models = [
        'MenuArchitect' => MenuArchitect::class,
        'MenuArchitectItem' => MenuArchitectItem::class,
    ];

    public function model($name)
    {
        return app($this->models[Str::studly($name)]);
    }

    public function modelClass($name)
    {
        return $this->models[$name];
    }
}
