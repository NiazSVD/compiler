<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use App\Models\Language; 
use App\Models\Menu;
use App\Models\MultiLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('translations')->orderBy('order')->get();
        $pages = DynamicPage::where('status', 'active')->orderBy('order')->get();
        $languages = Language::where('is_active', true)->get();

        $multiLanguages = MultiLang::where('active', 1)->get();

        return view('backend.menu.index', compact('menus', 'pages', 'languages', 'multiLanguages'));
    }


    public function store(Request $request)
    {
        $multiLanguages = MultiLang::where('active', 1)->get();

        $rules = [
            'menu_type' => 'required|in:page,language',
            'position' => 'required|string',
            'status' => 'required|boolean',
        ];

        foreach ($multiLanguages as $lang) {
            $rules['name_' . $lang->code] = $lang->code == 'en' ? 'required|string|max:255' : 'nullable|string|max:255';
        }
        $request->validate($rules);

        DB::beginTransaction();
        try {
            $menu = Menu::create([
                'name'      => $request->name_en,
                'menu_type' => $request->menu_type,
                'position'  => $request->position,
                'order'     => $request->order ?? 0,
                'status'    => $request->status,
                'page_id'   => $request->menu_type === 'page' ? $request->dynamic_id : null,
                'lang_id'   => $request->menu_type === 'language' ? $request->dynamic_id : null,
            ]);

            foreach ($multiLanguages as $lang) {
                $inputName = 'name_' . $lang->code;
                if ($request->filled($inputName)) {
                    $menu->translations()->create([
                        'locale' => $lang->code,
                        'key'    => 'name',
                        'value'  => $request->$inputName,
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Menu created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }


    public function edit($id)
    {
        $menu = Menu::with('translations')->findOrFail($id);

        return response()->json($menu);
    }


    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $multiLanguages = MultiLang::where('active', 1)->get();

        $rules = [
            'menu_type' => 'required|in:page,language',
            'position' => 'required|string',
            'status' => 'required|boolean',
        ];
        foreach ($multiLanguages as $lang) {
            $rules['name_' . $lang->code] = $lang->code == 'en' ? 'required|string|max:255' : 'nullable|string|max:255';
        }
        $request->validate($rules);

        DB::beginTransaction();
        try {
            $menu->update([
                'name'      => $request->name_en,
                'menu_type' => $request->menu_type,
                'position'  => $request->position,
                'order'     => $request->order ?? 0,
                'status'    => $request->status,
                'page_id'   => $request->menu_type === 'page' ? $request->dynamic_id : null,
                'lang_id'   => $request->menu_type === 'language' ? $request->dynamic_id : null,
            ]);

            foreach ($multiLanguages as $lang) {
                $inputName = 'name_' . $lang->code;
                $menu->translations()->updateOrCreate(
                    ['locale' => $lang->code, 'key' => 'name'],
                    ['value' => $request->$inputName]
                );
            }

            DB::commit();
            return redirect()->back()->with('success', 'Menu updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Update failed!');
        }
    }


    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->translations()->delete();
        $menu->delete();

        return redirect()->back()->with('success', 'Menu deleted successfully');
    }
}
