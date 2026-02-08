<?php

namespace App\Http\Controllers;

use App\Models\MultiLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MultiLangController extends Controller
{
    public function index()
    {
        $langs = MultiLang::orderBy('name')->get();
        return view('backend.multi_languages.index', compact('langs'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:5|unique:multi_langs,code',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()
            ]);
        }

        MultiLang::create([
            'name' => $request->name,
            'code' => strtolower($request->code),
            'active' => $request->has('active') ? 1 : 0,
        ]);

        return response()->json(['status' => 1, 'message' => 'Language added successfully.']);
    }



    public function update(Request $request, $id)
    {
        $lang = MultiLang::findOrFail($id);

        $oldCode = $lang->code;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:5|unique:multi_langs,code,' . $lang->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()
            ]);
        }

        $newCode = strtolower($request->code);

        DB::beginTransaction();
        try {

            $lang->update([
                'name' => $request->name,
                'code' => $newCode,
                'active' => $request->has('active') ? 1 : 0,
            ]);

            if ($oldCode !== $newCode) {
                \App\Models\Translation::where('locale', $oldCode)
                    ->update(['locale' => $newCode]);

                if (session('locale') == $oldCode) {
                    session(['locale' => $newCode]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => 'Language updated and translations migrated successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }



    public function destroy($id)
    {
        $language = MultiLang::findOrFail($id);
        $langCode = $language->code;

        DB::beginTransaction();
        try {
            \App\Models\Translation::where('locale', $langCode)->delete();

            $language->delete();

            DB::commit();
            return redirect()->route('admin.multi_languages.index')
                ->with('success', 'Language and all associated translations deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Failed to delete language: ' . $e->getMessage());
        }
    }
}
