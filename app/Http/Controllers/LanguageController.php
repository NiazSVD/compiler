<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::orderByDesc('is_active')->get();

        return view('backend.language.index', compact('languages'));
    }

    public function create()
    {
        return view('backend.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
        ]);


        Language::create([
            'name' => strtolower($request->name),
            'display_name' => $request->display_name,
            'version' => $request->version ?? 'latest',
            'runtime' => $request->runtime ?? strtolower($request->name),
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'is_active' => $request->is_active ?? false,
        ]);


        return redirect()->route('admin.languages.index')
            ->with('success', 'Language added');
    }

    public function edit(Language $language)
    {
        return view('backend.language.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $language->update([
            'display_name' => $request->display_name,
            'is_active' => $request->is_active ?? false,
            'is_default' => $request->is_default ?? false,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($language->display_name),
            'icon' => $request->icon,
            'icon_color' => $request->icon_color,
            'description' => $request->description,
        ]);

        if ($request->is_default) {
            Language::where('id', '!=', $language->id)
                ->update(['is_default' => false]);
        }


        return redirect()->route('admin.languages.index')
            ->with('success', 'Language updated');
    }

    public function destroy(Language $language)
    {
        $language->delete();
        return back()->with('success', 'Language removed');
    }

    public function syncPiston()
    {
        $runtimes = Http::get('https://emkc.org/api/v2/piston/runtimes')->json();

        foreach ($runtimes as $rt) {

            $exists = Language::where('name', $rt['language'])
                ->where('version', $rt['version'])
                ->exists();

            if ($exists) {
                continue;
            }

            $baseSlug = Str::slug($rt['language']);
            $slug = $baseSlug;
            $i = 1;

            while (Language::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i;
                $i++;
            }

            Language::create([
                'name'         => $rt['language'],
                'version'      => $rt['version'],
                'display_name' => strtoupper($rt['language']),
                'runtime'      => $rt['runtime'] ?? strtolower($rt['language']),
                'slug'         => $slug,
                'is_active'    => false,
                'is_default'   => false
            ]);
        }

        return back()->with('success', 'New Piston languages synced successfully!');
    }
}
