<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
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
        ]);

        try {

            $baseSlug = $request->page_slug
                ? Str::slug($request->page_slug)
                : Str::slug($request->page_title);

            $uniqueSlug = $this->generateUniqueSlug($baseSlug);

            $page = new DynamicPage();
            $page->page_title   = $request->page_title;
            $page->page_content = $request->page_content;
            $page->order        = $request->order;
            $page->page_slug    = $uniqueSlug;
            $page->status       = $request->status;
            $page->save();

            return redirect()
                ->route('admin.dynamic_page.index')
                ->with('success', 'Page created successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to create page')
                ->withInput();
        }
    }

    public function edit(string $id)
    {
        $page = DynamicPage::findOrFail($id);
        return view('backend.dynamic_page.edit', compact('page'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'page_title'   => 'required|string|max:255',
            'page_content' => 'required',
            'page_slug'    => 'nullable|string|max:255',
        ]);

        $page = DynamicPage::findOrFail($id);

        $baseSlug = $request->page_slug
            ? Str::slug($request->page_slug)
            : Str::slug($request->page_title);

        $slug = $baseSlug;
        $count = 1;
        while (DynamicPage::where('page_slug', $slug)->where('id', '!=', $page->id)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        $page->page_title   = $request->page_title;
        $page->page_content = $request->page_content;
        $page->order        = $request->order;
        $page->page_slug    = $slug;
        $page->status       = $request->status;
        $page->save();

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
