<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use App\Models\HomeSettings;
use App\Models\Language;
use App\Models\MultiLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DynamicPageController extends Controller
{
    public function index()
    {
        $pages = DynamicPage::latest()->get();
        return view('backend.dynamic_page.index', compact('pages'));
    }


    public function create()
    {
        $multiLanguages = MultiLang::where('active', 1)->get();
        return view('backend.dynamic_page.create', compact('multiLanguages'));
    }


    public function store(Request $request)
    {
        $multiLanguages = MultiLang::where('active', 1)->get();

        // ১. ডাইনামিক ভ্যালিডেশন
        $rules = [
            'page_slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('dynamic_pages', 'page_slug')
            ],
            'order' => 'nullable|integer',
        ];

        foreach ($multiLanguages as $lang) {
            $rules['page_title_' . $lang->code] = $lang->code == 'en' ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules['page_content_' . $lang->code] = $lang->code == 'en' ? 'required' : 'nullable';
        }
        $request->validate($rules);

        DB::beginTransaction();
        try {
            // ২. স্লাগ জেনারেট করা (ইংরেজি টাইটেল থেকে)
            $baseSlug = $request->page_slug ? Str::slug($request->page_slug) : Str::slug($request->page_title_en);
            $uniqueSlug = $this->generateUniqueSlug($baseSlug);

            // ৩. মেইন টেবিলে ডাটা সেভ
            $page = new DynamicPage();
            $page->page_title   = $request->page_title_en; // ব্যাকআপ হিসেবে ইংরেজি নাম
            $page->page_content = $request->page_content_en; // ব্যাকআপ কন্টেন্ট
            $page->page_slug    = $uniqueSlug;
            $page->order        = $request->order ?? 0;
            $page->status       = $request->has('set_home') ? 'active' : ($request->status === 'active' ? 'active' : 'inactive');
            $page->meta_title   = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->meta_tags    = $request->meta_tags;
            $page->save();

            // ৪. ট্রান্সলেশন টেবিলে লুপ চালিয়ে সেভ করা
            foreach ($multiLanguages as $lang) {
                $titleKey = 'page_title_' . $lang->code;
                $contentKey = 'page_content_' . $lang->code;

                // টাইটেল সেভ
                if ($request->filled($titleKey)) {
                    $page->translations()->create([
                        'locale' => $lang->code,
                        'key'    => 'page_title',
                        'value'  => $request->$titleKey,
                    ]);
                }

                // কন্টেন্ট সেভ
                if ($request->filled($contentKey)) {
                    $page->translations()->create([
                        'locale' => $lang->code,
                        'key'    => 'page_content',
                        'value'  => $request->$contentKey,
                    ]);
                }
            }

            // হোম সেটিংস আপডেট (যদি থাকে)
            if ($request->input('set_home') == 1) {
                HomeSettings::updateOrCreate(['id' => 1], ['type' => 'page', 'slug' => $uniqueSlug]);
            }

            DB::commit();
            return redirect()->route('admin.dynamic_page.index')->with('success', 'Page created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed: ' . $e->getMessage())->withInput();
        }
    }


    public function edit(string $id)
    {
        $multiLanguages = MultiLang::where('active', 1)->get();

        $page = DynamicPage::findOrFail($id);

        $page->is_home = optional(HomeSettings::where('type', 'page')->first())->slug === $page->page_slug ? 1 : 0;

        return view('backend.dynamic_page.edit', compact('page', 'multiLanguages'));
    }


    public function update(Request $request, string $id)
    {
        $page = DynamicPage::findOrFail($id);
        $multiLanguages = \App\Models\MultiLang::where('active', 1)->get();

        $rules = [
            'page_slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('dynamic_pages', 'page_slug')->ignore($page->id),
                function ($attr, $value, $fail) {

                    if (\App\Models\Language::where('slug', $value)->exists()) {
                        $fail('This slug is reserved for language.');
                    }
                },
            ],
            'order'            => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_tags'        => 'nullable|string',
            'meta_description' => 'nullable|string|max:160',
        ];

        foreach ($multiLanguages as $lang) {
            $rules['page_title_' . $lang->code] = $lang->code == 'en' ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules['page_content_' . $lang->code] = $lang->code == 'en' ? 'required' : 'nullable';
        }

        $request->validate($rules);

        DB::beginTransaction();
        try {

            $baseSlug = $request->page_slug
                ? Str::slug($request->page_slug)
                : Str::slug($request->page_title_en);

            $slug = $this->generateUniqueSlug($baseSlug, $page->id);

            $page->update([
                'page_title'       => $request->page_title_en,
                'page_content'     => $request->page_content_en,
                'page_slug'        => $slug,
                'order'            => $request->order,
                'status'           => $request->has('set_home') ? 'active' : ($request->status === 'active' ? 'active' : 'inactive'),
                'meta_title'       => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_tags'        => $request->meta_tags,
            ]);


            foreach ($multiLanguages as $lang) {

                $page->translations()->updateOrCreate(
                    ['locale' => $lang->code, 'key' => 'page_title'],
                    ['value' => $request->input('page_title_' . $lang->code)]
                );

                $page->translations()->updateOrCreate(
                    ['locale' => $lang->code, 'key' => 'page_content'],
                    ['value' => $request->input('page_content_' . $lang->code)]
                );
            }

            if ($request->input('set_home') == 1) {
                \App\Models\HomeSettings::updateOrCreate(
                    ['id' => 1],
                    [
                        'type' => 'page',
                        'slug' => $slug,
                    ]
                );
            } else {

                \App\Models\HomeSettings::where('id', 1)
                    ->where('slug', $page->getOriginal('page_slug'))
                    ->delete();
            }

            DB::commit();
            return redirect()
                ->route('admin.dynamic_page.index')
                ->with('success', 'Page updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Failed to update page: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function delete(string $id)
    {
        try {
            $page = DynamicPage::findOrFail($id);
            $page->delete();
            return redirect()->route('admin.dynamic_page.index')->with('success', 'Page deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.dynamic_page.index')->with('error', 'Failed to delete page.');
        }
    }


    private function generateUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $originalSlug = $slug;
        $count = 1;

        while (
            DynamicPage::where('page_slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
            || Language::where('slug', $slug)->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
