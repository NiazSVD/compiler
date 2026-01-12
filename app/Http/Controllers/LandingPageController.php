<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $landing = LandingPage::first();

        return view('backend.landing_page.index', compact('landing'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'header_text' => 'required|string|max:255',
            'header_description' => 'nullable|string',
            'description' => 'nullable|string',
            'header_color' => 'nullable|string',
            'hero_color' => 'nullable|string',
            'body_color' => 'nullable|string',
            'footer_color' => 'nullable|string',
            'language_color' => 'nullable|string',
        ]);

        $landing = LandingPage::first();

        if (!$landing) {
            $landing = LandingPage::create($request->only([
                'header_text',
                'header_description',
                'description',
                'header_color',
                'hero_color',
                'body_color',
                'footer_color',
                'language_color'

            ]));
        } else {
            $landing->update($request->only([
                'header_text',
                'header_description',
                'description',
                'header_color',
                'hero_color',
                'body_color',
                'footer_color',
                'language_color'
            ]));
        }

        return back()->with('success', 'Landing page updated successfully');
    }
}
