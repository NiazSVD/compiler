<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use App\Models\HomeSettings;
use App\Models\Language;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class DynamicHomeController extends Controller
{
    public function index()
    {
        return view('backend.dynamic_home.index', [
            'languages' => Language::where('is_active', 1)->get(),
            'pages'     => DynamicPage::where('status', 'active')->get(),
            'home'      => HomeSettings::first()
        ]);
    }

    public function updateHome(Request $request)
    {
        $request->validate([
            'type' => ['required', Rule::in(['page', 'language'])],
            'slug' => ['required', 'string'],
        ]);

        if ($request->type === 'page') {
            if ($request->slug !== 'landing') {
                $request->validate([
                    'slug' => [
                        Rule::exists('dynamic_pages', 'page_slug')
                    ]
                ]);
            }
        }

        if ($request->type === 'language') {
            $request->validate([
                'slug' => [
                    Rule::exists('languages', 'slug')
                ]
            ]);
        }

        $home = HomeSettings::firstOrNew(['id' => 1]);
        $home->type = $request->type;
        $home->slug = $request->slug;
        $home->save();

        return back()->with('success', 'Home page updated successfully');
    }
}
