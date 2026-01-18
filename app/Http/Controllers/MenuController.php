<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use App\Models\Language;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order')->get();
        $pages = DynamicPage::where('status', 'active')->orderBy('order')->get();
        $languages = Language::where('is_active', true)->get();

        return view('backend.menu.index', compact('menus', 'pages', 'languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'menu_type' => 'required|in:page,language',
            'dynamic_id' => 'nullable|integer',
            'position' => 'required|string',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'menu_type' => $request->menu_type,
            'position' => $request->position,
            'order' => $request->order ?? 0,
            'status' => $request->status,
        ];

        if ($request->menu_type === 'page') {
            $data['page_id'] = $request->dynamic_id;
            $data['lang_id'] = null;
        } else if ($request->menu_type === 'language') {
            $data['lang_id'] = $request->dynamic_id;
            $data['page_id'] = null;
        }

        Menu::create($data);

        return redirect()->back()->with('success', 'Menu created successfully');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'menu_type' => 'required|in:page,language',
            'dynamic_id' => 'nullable|integer',
            'position' => 'required|string',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'menu_type' => $request->menu_type,
            'position' => $request->position,
            'order' => $request->order ?? 0,
            'status' => $request->status,
        ];

        if ($request->menu_type === 'page') {
            $data['page_id'] = $request->dynamic_id;
            $data['lang_id'] = null;
        } else if ($request->menu_type === 'language') {
            $data['lang_id'] = $request->dynamic_id;
            $data['page_id'] = null;
        }

        $menu->update($data);

        return redirect()->back()->with('success', 'Menu updated successfully');
    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->back()->with('success', 'Menu deleted successfully');
    }

}
