<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $landingArray = DB::table('landing_pages')->pluck('value', 'key')->toArray();
        $landing = (object) $landingArray;
        return view('backend.landing_page.index', compact('landing'));
    }

    public function update(Request $request)
    {
        // ===== COLORS =====
        $this->updateKeyValue('theme_color', $request->theme_color);

        // ===== HEADER =====
        $this->updateKeyValue('header_sub_title', $request->header_sub_title);
        $this->updateKeyValue('header_title', $request->header_title);
        $this->updateKeyValue('header_short_description', $request->header_short_description);

        // ===== LANGUAGE =====
        $this->updateKeyValue('lang_header', $request->lang_header);
        $this->updateKeyValue('lang_description', $request->lang_description);

        // ===== ABOUT TOP =====
        $this->updateKeyValue('about_header', $request->about_header);
        $this->updateKeyValue('about_short_description', $request->about_short_description);
        $this->updateKeyValue('about_description', $request->about_description);

        // ===== ABOUT CARDS 1–9 =====
        for ($i = 1; $i <= 9; $i++) {

            $iconField = 'about_card_icon_' . $i;
            if ($request->hasFile($iconField)) {

                $oldFile = DB::table('landing_pages')->where('key', $iconField)->value('value');

                if ($oldFile && file_exists(public_path(str_replace(url('/') . '/', '', $oldFile)))) {
                    unlink(public_path(str_replace(url('/') . '/', '', $oldFile)));
                }

                $file = $request->file($iconField);
                $filename = time() . '_' . $i . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/landing/about'), $filename);

                $fullUrl = url('uploads/landing/about/' . $filename);
                $this->updateKeyValue($iconField, $fullUrl);
            }

            $this->updateKeyValue('about_card_header_' . $i, $request->{'about_card_header_' . $i});
            $this->updateKeyValue('about_card_description_' . $i, $request->{'about_card_description_' . $i});
        }

        // ===== ABOUT BOTTOM =====
        $this->updateKeyValue('about_header_2', $request->about_header_2);
        $this->updateKeyValue('about_short_description_2', $request->about_short_description_2);

        // ===== FOOTER =====
        $this->updateKeyValue('footer_text', $request->footer_text);

        return redirect()->back()->with('success', 'Landing page updated successfully');
    }


    private function updateKeyValue($key, $value)
    {
        DB::table('landing_pages')->updateOrInsert(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
