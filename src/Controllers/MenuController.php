<?php

namespace Rc1021\LaravelMenuArchitect\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rc1021\LaravelMenuArchitect\Repositories\MenuRepository;

class MenuController extends Controller
{
    protected $m_rep;
    protected $m_table;

    public function __construct (MenuRepository $rep) 
    {
        $this->m_rep = $rep;
        $this->m_table = config('menu_architect.table_prefix').config('menu_architect.table_name_menus');
    }

    public function index()
    {
        $model = $this->m_rep->getIndexViewModel();
        return view('menu_architect::menu.index', compact('model'));
    }

    public function create()
    {
        $model = $this->m_rep->getCreateViewModel();
        return view('menu_architect::menu.create', compact('model'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => "required|unique:{$this->m_table}|max:255",
        ]);
        
        $result = $this->m_rep->store($request->input());
        return redirect()->route('menu_arct.edit', [$result]);
    }

    public function edit($id)
    {
        $model = $this->m_rep->getEditViewModel($id);
        return view('menu_architect::menu.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->m_rep->update($request->input(), $id);
        return redirect()->route('menu_arct.show', [$result]);
    }

    public function destroy($id)
    {
        $this->m_rep->destroy($id);
        return redirect()->route('menu_arct.index');
    }

    public function example() 
    {
        return view('menu_architect::example');
    }
}
