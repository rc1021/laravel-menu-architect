<?php

namespace Rc1021\LaravelMenuArchitect\Traits;

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Html;

trait MenuArctDataFormat
{
    public function toArray($root_id = 0) 
    {
       $arr = $this->m_items->toArray(); 
       return $this->buildTree($arr, $root_id);
    }

    public function toJson() 
    {
       return json_decode(json_encode($this->toArray()));
    }
}