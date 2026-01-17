<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use App\Models\HomeSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DynamicPageController extends Controller
{
    public function index()
    {
        $pages = DynamicPage::latest()->get();
        return view('backend.dynamic_page.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.dynamic_page.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'page_title'   => 'required|string|max:255',
            'page_content' => 'required',
            'page_slug'    => 'nullable|string|max:255',
            'order'        => 'nullable|integer',
        ]);

        try {
            $baseSlug = $request->page_slug
                ? Str::slug($request->page_slug)
                : Str::slug($request->page_title);

            $uniqueSlug = $this->generateUniqueSlug($baseSlug);

            if ($request->input('set_home') == 1) {
                $status = 'active';
            } else {
                $status = $request->input('status') === 'active'
                    ? 'active'
                    : 'inactive';
            }

            $page = new DynamicPage();
            $page->page_title   = $request->page_title;
            $page->page_content = $request->page_content;
            $page->order        = $request->order;
            $page->page_slug    = $uniqueSlug;
            $page->status       = $status;
            $page->save();

            if ($request->input('set_home') == 1) {
                HomeSettings::updateOrCreate(
                    ['id' => 1],
                    [
                        'type' => 'page',
                        'slug' => $uniqueSlug,
                    ]
                );
            }

            return redirect()
                ->route('admin.dynamic_page.index')
                ->with('success', 'Page created successfully');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Failed to create page')
                ->withInput();
        }
    }






    public function edit(string $id)
{
    $page = DynamicPage::findOrFail($id);

    // Check if this page is current home page
    $page->is_home = optional(HomeSettings::where('type', 'page')->first())->slug === $page->page_slug ? 1 : 0;

    return view('backend.dynamic_page.edit', compact('page'));
}

public function update(Request $request, string $id)
{
    $request->validate([
        'page_title'   => 'required|string|max:255',
        'page_content' => 'required',
        'page_slug'    => 'nullable|string|max:255',
        'order'        => 'nullable|integer',
    ]);

    $page = DynamicPage::findOrFail($id);

    // Generate unique slug
    $baseSlug = $request->page_slug
        ? Str::slug($request->page_slug)
        : Str::slug($request->page_title);

    $slug = $baseSlug;
    $count = 1;
    while (DynamicPage::where('page_slug', $slug)->where('id', '!=', $page->id)->exists()) {
        $slug = $baseSlug . '-' . $count++;
    }

    $page->page_title   = $request->page_title;
    $page->page_content = $request->page_content;
    $page->order        = $request->order;
    $page->page_slug    = $slug;

    // ENUM-safe status (unchanged unless checkbox checked)
    $page->status = in_array($request->input('status'), ['active','inactive'])
        ? $request->input('status')
        : 'inactive';

    $page->save();

    // Handle Set as Home Page
    if ($request->input('set_home') == 1) {
        HomeSettings::updateOrCreate(
            ['id' => 1],
            [
                'type' => 'page',
                'slug' => $page->page_slug,
            ]
        );
    } else {
        // Optional: remove if unchecked
        HomeSettings::where('id', 1)
            ->where('slug', $page->page_slug)
            ->delete();
    }

    return redirect()
        ->route('admin.dynamic_page.index')
        ->with('success', 'Page updated successfully');
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

    public function changeStatus($id)
    {
        $data = DynamicPage::find($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }


        // Toggle status
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data' => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data' => $data,
            ]);
        }
        $page->save();
        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.'
        ]);
    }



    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        while (DynamicPage::where('page_slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
