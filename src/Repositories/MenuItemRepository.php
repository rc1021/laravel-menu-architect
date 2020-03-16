<?php

namespace Rc1021\LaravelMenuArchitect\Repositories;

use DB;
use Illuminate\Http\Request;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitect;
use Rc1021\LaravelMenuArchitect\Models\MenuArchitectItem;
use Rc1021\LaravelMenuArchitect\Facades\MenuArct;

class MenuItemRepository
{
    public function getIndexViewModel()
    {
    }

    public function getCreateViewModel($id)
    {
        return (object)[
            'data' => MenuArchitect::findOrFail($id)
        ];   
    }

    public function store($input)
    {
        $input['sort'] = $this->getMaxSort();
        $collection = collect($input);
        $filtered = $collection->only(['label', 'link', 'route', 'query_string', 'class', 'menu_id', 'icon', 'color', 'target', 'sort']);

        return MenuArchitectItem::create($filtered->toArray());
    }

    private function getMaxSort($parent_id = 0) {
        return (int)MenuArchitectItem::where('parent_id', $parent_id)->max('sort') | 0;
    }

    public function getEditViewModel($id)
    {
        return (object)[
            'data' => MenuArchitectItem::findOrFail($id)
        ];   
    }

    public function update($input, $id)
    {
        $collection = collect($input);
        $filtered = $collection->only(['label', 'link', 'route', 'query_string', 'class', 'menu_id', 'icon', 'color', 'target']);

        $item = MenuArchitectItem::findOrFail($id);
        $item->fill($filtered->toArray());
        $item->save();
        
        $item = MenuArchitectItem::findOrFail($id);
        $children = menu_arct($item->menu->name, '_array', ['root_id' => $item->id]);
        if($children && count($children) > 0) {
            $data = $item->toArray();
            $data['children'] = $children;
            return $data;
        }
        return $item->toArray();
    }

    public function destroy($id)
    {
        $item = MenuArchitectItem::findOrFail($id);
        DB::transaction(function () use ($item) {
            $count = MenuArchitectItem::where('parent_id', $item->id)->count();

            DB::table($item->getTable())
                ->where('parent_id', $item->parent_id)
                ->where('sort', '>', $item->sort)
                ->increment('sort', $count - 1);

            DB::table($item->getTable())
                ->where('parent_id', $item->id)
                ->increment('sort', $item->sort - 1, [
                    'parent_id' => $item->parent_id,
                    'depth' => $item->depth
                ]);

            DB::table($item->getTable())->where('id', $item->id)->delete();
        });
    }

    public function sort($request, $id) 
    {
        $item = MenuArchitectItem::findOrFail($id);
        DB::transaction(function () use ($request, $item) {
            DB::table($item->getTable())
                ->where('parent_id', $item->parent_id)
                ->where('sort', '>', $item->sort)
                ->decrement('sort');
            
            $parent = MenuArchitectItem::find($request->input('parent_id', 0));
            $prev = MenuArchitectItem::find($request->input('prev_id', 0));
            $sort = 0;
            if($prev)
                $sort = $prev->sort;

            DB::table($item->getTable())
                ->where('parent_id', $request->input('parent_id', 0))
                ->where('sort', '>', $sort)
                ->increment('sort');

            DB::table($item->getTable())
                ->where('id', $item->id)
                ->update([
                    'parent_id' => $request->input('parent_id', 0),
                    'sort' => $sort + 1,
                    'depth' => ($parent) ? $parent->depth + 1 : 0
                ]);
        });
    }

}