<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use Illuminate\Validation\Rule;
use App\Models\Language;
use App\Models\MultiLang;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'name'           => 'required|string|max:255',
            'display_name'   => 'required|string|max:255',
            'slug'           => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('languages', 'slug'),
                function ($attr, $value, $fail) {
                    if (DynamicPage::where('page_slug', $value)->exists()) {
                        $fail('This slug is reserved for a dynamic page.');
                    }
                },
            ],
            'icon'            => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description'     => 'nullable|string',

            'meta_title'       => 'nullable|string',
            'meta_tags'        => 'nullable|string',
            'meta_description' => 'nullable|string',

            'is_active'       => 'nullable|boolean',
            'is_default'      => 'nullable|boolean',
            'version'         => 'nullable|string|max:50',
            'runtime'         => 'nullable|string|max:50',
        ]);

        $baseSlug = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        $uniqueSlug = $this->generateUniqueSlugForLanguage($baseSlug);

        $data = [
            'name'              => strtolower($request->name),
            'display_name'      => $request->display_name,
            'version'           => $request->version ?? 'latest',
            'runtime'           => $request->runtime ?? strtolower($request->name),
            'slug'              => $uniqueSlug,
            'description'       => $request->description,

            'meta_title'        => $request->meta_title,
            'meta_tags'         => $request->meta_tags,
            'meta_description'  => $request->meta_description,

            'is_active'         => $request->is_active ?? false,
            'is_default'        => $request->is_default ?? false,
        ];

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');

            $uploadPath = public_path('uploads/languages');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);

            $data['icon'] = 'uploads/languages/' . $filename;
        }

        $language = Language::create($data);

        if ($request->is_default) {
            Language::where('id', '!=', $language->id)
                ->update(['is_default' => false]);
        }

        return redirect()
            ->route('admin.languages.index')
            ->with('success', 'Language added successfully');
    }


    public function edit(Language $language)
    {
        $multiLanguages = MultiLang::where('active', 1)->get();
        return view('backend.language.edit', compact('language', 'multiLanguages'));
    }


    public function update(Request $request, Language $language)
    {
        $multiLanguages = MultiLang::where('active', 1)->get();

        $rules = [
            'is_active'    => 'nullable|boolean',
            'is_default'   => 'nullable|boolean',
            'slug'         => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('languages', 'slug')->ignore($language->id),
                function ($attr, $value, $fail) {
                    if (DynamicPage::where('page_slug', $value)->exists()) {
                        $fail('This slug is reserved for a dynamic page.');
                    }
                },
            ],
            'icon'             => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'meta_title'       => 'nullable|string',
            'meta_tags'        => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];

        foreach ($multiLanguages as $lang) {
            $rules['display_name_' . $lang->code] = $lang->code == 'en' ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules['description_' . $lang->code]  = 'nullable|string';
        }
        $request->validate($rules);

        DB::beginTransaction();
        try {
            $data = [
                'display_name'     => $request->display_name_en,
                'is_active'        => $request->is_active ?? false,
                'is_default'       => $request->is_default ?? false,
                'slug'             => $request->slug ? Str::slug($request->slug) : Str::slug($request->display_name_en),
                'description'      => $request->description_en,
                'meta_title'       => $request->meta_title,
                'meta_tags'        => $request->meta_tags,
                'meta_description' => $request->meta_description,
            ];

            if ($request->hasFile('icon')) {
                if ($language->icon && file_exists(public_path($language->icon))) {
                    unlink(public_path($language->icon));
                }
                $image = $request->file('icon');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/languages'), $filename);
                $data['icon'] = 'uploads/languages/' . $filename;
            }

            $language->update($data);

            foreach ($multiLanguages as $lang) {

                $language->translations()->updateOrCreate(
                    ['locale' => $lang->code, 'key' => 'display_name'],
                    ['value' => $request->input('display_name_' . $lang->code)]
                );

                $language->translations()->updateOrCreate(
                    ['locale' => $lang->code, 'key' => 'description'],
                    ['value' => $request->input('description_' . $lang->code)]
                );
            }

            if ($request->is_default) {
                Language::where('id', '!=', $language->id)->update(['is_default' => false]);
            }

            DB::commit();
            return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
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


    private function generateUniqueSlugForLanguage(string $slug): string
    {
        $originalSlug = $slug;
        $count = 1;

        while (
            Language::where('slug', $slug)->exists()
            || DynamicPage::where('page_slug', $slug)->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
