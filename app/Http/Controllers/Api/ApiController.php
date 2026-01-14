<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $languages = Language::where('is_active', true)
            ->orderBy('display_name')
            ->get();

        // $defaultLanguage = Language::where('is_default', true)->first();
        $landing = LandingPage::first();

        $setting = Setting::first();

        return response()->json([
            'success' => 200,
            'data' => [
                'language' => $languages,
                'landing' => $landing,
                'setting' => $setting
            ]
        ]);
    }
}
