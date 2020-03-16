<?php

namespace Rc1021\LaravelMenuArchitect\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Rc1021\LaravelMenuArchitect\Facades\MenuArct;

class MenuArchitect extends Model
{
    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->removeMenuFromCache();
        });

        static::deleted(function ($model) {
            $model->removeMenuFromCache();
        });
    }

    public function items()
    {
        return $this->hasMany(MenuArct::modelClass('MenuArchitectItem'), 'menu_id');
    }
    
    public static function output($menuName, $type = null, array $options = [])
    {
        $menu = \Cache::remember('menu_architect_menu_'.$menuName, \Carbon\Carbon::now()->addDays(30), function () use ($menuName) {
            return static::where('name', $menuName)->with(['items' => function ($q) {
                $q->orderBy('sort');
            }])
            ->first();
        });

        if (!isset($menu)) {
            return false;
        }

        if(is_null($type))
            $type = config('menu_architect.output');

        switch($type) 
        {
            case '_array':
                $root_id = Arr::get($options, 'root_id', 0);
                return $menu->buildTree($root_id);
                break;
            case '_json':
                return json_decode(json_encode($menu->buildTree()));
                break;
        }

        if(empty($type))
            return "You can change <code>config('menu_architect.output')</code> to output the correct html";

        // get view name
        $type = 'menu_architect::menu.display.'.$type;

        return new \Illuminate\Support\HtmlString(
            \Illuminate\Support\Facades\View::make($type, [
                'menu' => $menu, 
                'items' => $menu->buildTree(), 
                'options' => (object)$options
            ])->render()
        );
    }

    public function removeMenuFromCache()
    {
        \Cache::forget('menu_architect_menu_'.$this->name);
    }

    /**
     * @param $flatList - a flat list of tree nodes; a node is an array with keys: id, parent_id, name.
     */
    function buildTree($root_id = 0, $parent_key = 'parent_id', $child_key = 'children')
    {
        $flat_list = $this->items;
        if(count($flat_list) == 0)
            return [];

        $grouped = [];
        foreach ($flat_list as $node){
            $grouped[$node[$parent_key]][] = $node;
        }

        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $child_key) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling['id'];
                if(isset($grouped[$id])) {
                    $sibling[$child_key] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }
            return $siblings;
        };

        $tree = (isset($grouped[$root_id])) ? $fnBuilder($grouped[$root_id]) : [];

        return $tree;
    }
}
