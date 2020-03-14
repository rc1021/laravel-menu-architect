<?php 

namespace Rc1021\LaravelMenuArchitect;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Html;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitect;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitectItem;
use Rc1021\LaravelMenuArchitect\Traits\MenuArctOutput;
use Rc1021\LaravelMenuArchitect\Traits\MenuArctDataFormat;

class MenuArct
{
    use MenuArctOutput, MenuArctDataFormat;

    protected $m_menu;
    protected $m_items;

    public function model($menuNameOrID, $type = null, array $options = [])
    {
        $marct = new MenuArct();
        $menu = null;
        try {
            try {
                $menu = MenuArchitect::where('name', $menuNameOrID)->firstOrFail();
            }
            catch(ModelNotFoundException $e) {
                $menu = MenuArchitect::findOrFail($menuNameOrID);
            }
        }
        catch(ModelNotFoundException $e) {
            return null; 
        }
        $marct->m_menu = $menu;
        $marct->m_items = MenuArchitectItem::where('menu_id', $marct->m_menu->id)->orderBy('sort')->get();
        
        return $marct;
    }

    public function __toString() 
    {
        $result = "You can change <code>config('menu_architect.output')</code> to output the correct html";
        $this->output(config('menu_architect.output'));
        return $result;
    }

    public function output($output)
    {
        switch($output) {
            case 'bootstrap': 
                $result = $this->toBootstrap();
                break;
            case 'nestable': 
                $result = $this->toNestable();
            case 'adminlte-sidebar': 
                $result = $this->toAdminlteSidebar();
                break;
        }
    }

    public function format($format)
    {
        switch($format) {
            case 'array': 
                return $this->toArray();
                break;
            case 'json': 
                return $this->toJson();
                break;
        }
    }

    /**
     * @param $flatList - a flat list of tree nodes; a node is an array with keys: id, parent_id, name.
     */
    function buildTree(array $flat_list, $root_id = 0, $parent_key = 'parent_id', $child_key = 'children')
    {
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
