<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use App\Models\MultiLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $multiLanguages = MultiLang::where('active', 1)->get();
        $landing = LandingPage::all();

        return view('backend.landing_page.index', compact('landing', 'multiLanguages'));
    }


    public function update(Request $request)
    {
        $multiLanguages = \App\Models\MultiLang::where('active', 1)->get();

        $translatableFields = [
            'header_sub_title',
            'header_title',
            'header_short_description',
            'lang_header',
            'lang_description',
            'about_header',
            'about_short_description',
            'about_description',
            'about_header_2',
            'about_short_description_2',
            'footer_text',
            'meta_title',
            'meta_description',
            'meta_tags'
        ];

        for ($i = 1; $i <= 9; $i++) {
            $translatableFields[] = 'about_card_header_' . $i;
            $translatableFields[] = 'about_card_description_' . $i;
        }

        DB::beginTransaction();
        try {
            $this->updateKeyValue('theme_color', $request->theme_color);

            for ($i = 1; $i <= 9; $i++) {
                $iconField = 'about_card_icon_' . $i;
                if ($request->hasFile($iconField)) {
                    $oldRecord = \App\Models\LandingPage::where('key', $iconField)->first();
                    if ($oldRecord && $oldRecord->value) {
                        $oldPath = public_path(str_replace(url('/') . '/', '', $oldRecord->value));
                        if (file_exists($oldPath)) @unlink($oldPath);
                    }

                    $file = $request->file($iconField);
                    $filename = time() . '_' . $i . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/landing/about'), $filename);
                    $fullUrl = url('uploads/landing/about/' . $filename);
                    $this->updateKeyValue($iconField, $fullUrl);
                }
            }

            foreach ($translatableFields as $field) {
                $mainValue = $request->input($field . '_en') ?? '';

                $landingRecord = \App\Models\LandingPage::updateOrCreate(
                    ['key' => $field],
                    ['value' => $mainValue]
                );

                foreach ($multiLanguages as $lang) {
                    $inputName = $field . '_' . $lang->code;
                    if ($request->has($inputName)) {
                        $landingRecord->translations()->updateOrCreate(
                            ['locale' => $lang->code, 'key' => $field],
                            ['value' => $request->input($inputName)]
                        );
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Landing page updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }


    private function updateKeyValue($key, $value)
    {
        return \App\Models\LandingPage::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
