<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $languages = Language::where('is_active', true)
            ->orderBy('display_name')
            ->get();

        $landingRaw = DB::table('landing_pages')->get();

        $landing = [];
        foreach ($landingRaw as $item) {
            $landing[$item->key] = $item->value;
        }

        $setting = Setting::first();

        return response()->json([
            'success' => 200,
            'data' => [
                'language' => $languages,
                'landing'  => $landing,
                'setting'  => $setting,
            ]
        ]);
    }
}
