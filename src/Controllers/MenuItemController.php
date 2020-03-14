<?php

namespace Rc1021\LaravelMenuArchitect\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rc1021\LaravelMenuArchitect\Repositories\MenuItemRepository;

class MenuItemController extends Controller
{
    protected $m_rep;

    public function __construct (MenuItemRepository $rep) 
    {
        $this->m_rep = $rep;
    }

    public function index()
    {
        $model = $this->m_rep->getIndexViewModel();
        return view('menu_architect::menu_item.index', compact('model'));
    }

    public function create($menu_arct)
    {
        $model = $this->m_rep->getCreateViewModel($menu_arct);
        return view('menu_architect::menu_item.create', compact('model'));
    }

    public function store(Request $request, $menu_arct)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'New item is created.',
                'properties' => $this->m_rep->store($request->input())
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function edit($menu_arct, $menu_arct_item)
    {
        $model = $this->m_rep->getEditViewModel($menu_arct_item);
        return view('menu_architect::menu_item.edit', compact('model'));
    }

    public function update(Request $request, $menu_arct, $menu_arct_item)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Item is updated.',
                'properties' => $this->m_rep->update($request->input(), $menu_arct_item)
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy($menu_arct, $menu_arct_item)
    {
        try {
            $this->m_rep->destroy($menu_arct_item);
            return response()->json([
                'id' => $menu_arct_item
            ]);
        }
        catch(ModelNotFoundException $e) {
            abort(404);
        }
        catch(Exception $e) {
            abort(409, $e->getMessage());
        }
    }

    public function sort(Request $request, $menu_arct, $menu_arct_item)
    {
        try {
            $result = $this->m_rep->sort($request, $menu_arct_item);
            return "Successfully updated menu order";
        }
        catch(ModelNotFoundException $e) {
            abort(404);
        }
        catch(Exception $e) {
            abort(409, $e->getMessage());
        }
    }
}
