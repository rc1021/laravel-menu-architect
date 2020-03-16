<?php

namespace Rc1021\LaravelMenuArchitect\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Rc1021\LaravelMenuArchitect\Facades\MenuArct;

class MenuArchitectItem extends Model
{
    protected $fillable = [
        'label', 
        'link', 
        'route', 
        'query_string', 
        'parent_id', 
        'sort', 
        'class', 
        'menu_id', 
        'depth', 
        'icon', 
        'color', 
        'target'
    ];

    protected $appends = ['type', 'render_path'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->menu->removeMenuFromCache();
        });

        static::saved(function ($model) {
            $model->menu->removeMenuFromCache();
        });

        static::deleted(function ($model) {
            $model->menu->removeMenuFromCache();
        });
    }

    public function menu()
    {
        return $this->belongsTo(MenuArct::modelClass('MenuArchitect'));
    }

    public function getTypeAttribute()
    {
        return (empty($this->route)) ? "url" : "route";
    }

    public function getRenderPathAttribute()
    {
        if(!empty($this->route)) {
            $link = "";
            try {
                $args = json_decode($this->query_string, true);
                if(!$args)
                    parse_str($this->query_string, $args);
                    $link = route($this->route, $args);
            }
            catch(RouteNotFoundException $e) { 
                $link = $e->getMessage();
            }
            
            return str_replace(\App::make('url')->to('/'), '', $link);
        }
        else if(!empty($this->link)) {
            return $this->link;
        }
        return "#";
    }
    
}
