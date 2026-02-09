<?php

namespace App\Http\Controllers;

use App\Models\MultiLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

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
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()
            ]);
        }

        $flagName = null;
        if ($request->hasFile('flag')) {
            $file = $request->file('flag');
            $flagName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/flag'), $flagName);
        }

        MultiLang::create([
            'name' => $request->name,
            'code' => strtolower($request->code),
            'flag' => $flagName,
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
            'flag' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()
            ]);
        }

        $newCode = strtolower($request->code);

        // Image Handling
        if ($request->hasFile('flag')) {
            // Delete old flag if exists
            if ($lang->flag && File::exists(public_path('uploads/flag/' . $lang->flag))) {
                File::delete(public_path('uploads/flag/' . $lang->flag));
            }
            $file = $request->file('flag');
            $flagName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/flag'), $flagName);
            $lang->flag = $flagName;
        }

        DB::beginTransaction();
        try {
            $lang->name = $request->name;
            $lang->code = $newCode;
            $lang->active = $request->has('active') ? 1 : 0;
            $lang->save();

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
                'message' => 'Language updated successfully.'
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
            // Delete Flag File
            if ($language->flag && File::exists(public_path('uploads/flag/' . $language->flag))) {
                File::delete(public_path('uploads/flag/' . $language->flag));
            }

            \App\Models\Translation::where('locale', $langCode)->delete();
            $language->delete();

            DB::commit();
            return redirect()->route('admin.multi_languages.index')
                ->with('success', 'Language and associated data deleted.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Failed: ' . $e->getMessage());
        }
    }




    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:50',
    //         'code' => 'required|string|max:5|unique:multi_langs,code',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 0,
    //             'errors' => $validator->errors()
    //         ]);
    //     }

    //     MultiLang::create([
    //         'name' => $request->name,
    //         'code' => strtolower($request->code),
    //         'active' => $request->has('active') ? 1 : 0,
    //     ]);

    //     return response()->json(['status' => 1, 'message' => 'Language added successfully.']);
    // }



    // public function update(Request $request, $id)
    // {
    //     $lang = MultiLang::findOrFail($id);

    //     $oldCode = $lang->code;

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:50',
    //         'code' => 'required|string|max:5|unique:multi_langs,code,' . $lang->id,
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 0,
    //             'errors' => $validator->errors()
    //         ]);
    //     }

    //     $newCode = strtolower($request->code);

    //     DB::beginTransaction();
    //     try {

    //         $lang->update([
    //             'name' => $request->name,
    //             'code' => $newCode,
    //             'active' => $request->has('active') ? 1 : 0,
    //         ]);

    //         if ($oldCode !== $newCode) {
    //             \App\Models\Translation::where('locale', $oldCode)
    //                 ->update(['locale' => $newCode]);

    //             if (session('locale') == $oldCode) {
    //                 session(['locale' => $newCode]);
    //             }
    //         }

    //         DB::commit();
    //         return response()->json([
    //             'status' => 1,
    //             'message' => 'Language updated and translations migrated successfully.'
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json([
    //             'status' => 0,
    //             'message' => 'Error: ' . $e->getMessage()
    //         ]);
    //     }
    // }



    // public function destroy($id)
    // {
    //     $language = MultiLang::findOrFail($id);
    //     $langCode = $language->code;

    //     DB::beginTransaction();
    //     try {
    //         \App\Models\Translation::where('locale', $langCode)->delete();

    //         $language->delete();

    //         DB::commit();
    //         return redirect()->route('admin.multi_languages.index')
    //             ->with('success', 'Language and all associated translations deleted successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->back()
    //             ->with('error', 'Failed to delete language: ' . $e->getMessage());
    //     }
    // }
}
