<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use App\Models\HomeSettings;
use App\Models\LandingPage;
use App\Models\Language;
use App\Models\SharedCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\MultiLangsContent;

class FrontendController extends Controller
{
    public function index()
    {
        $home = HomeSettings::first();

        $languages = Language::where('is_active', true)
            ->orderBy('display_name')
            ->get();

        $landingRaw = LandingPage::all();

        $landing = [];
        foreach ($landingRaw as $item) {
            $landing[$item->key] = $item->getTranslation($item->key);
        }

        if (!$home) {
            return view('frontend.home', compact('languages', 'landing'));
        }

        if ($home->type === 'page') {
            if ($home->slug === 'landing') {
                return view('frontend.home', compact('languages', 'landing'));
            }

            $page = DynamicPage::with('translations')
                ->where('page_slug', $home->slug)
                ->where('status', 'active')
                ->first();

            if (!$page) {
                return view('frontend.home', compact('languages', 'landing'));
            }

            return view('frontend.dynamic_page', compact('page'));
        }

        if ($home->type === 'language') {
            $language = Language::with('translations')
                ->where('slug', $home->slug)
                ->where('is_active', true)
                ->first();

            if (!$language) {
                return view('frontend.home', compact('languages', 'landing'));
            }

            return view('frontend.editor', compact('languages', 'language'));
        }

        return view('frontend.home', compact('languages', 'landing'));
    }


    public function landing()
    {
        $languages = Language::where('is_active', true)
            ->orderBy('display_name')
            ->get();

        $landingRaw = LandingPage::all();
        $landing = [];
        foreach ($landingRaw as $item) {
            $landing[$item->key] = $item->getTranslation($item->key);
        }

        return view('frontend.home', compact('languages', 'landing'));
    }


    public function handle($slug)
    {
        $language = Language::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if ($language) {
            $landing = LandingPage::first();
            $languages = Language::where('is_active', true)->get();

            return view('frontend.editor', compact(
                'language',
                'languages',
                'landing'
            ));
        }

        $page = DynamicPage::where('page_slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('frontend.dynamic_page', compact('page'));
    }


    public function runCode(Request $request)
    {
        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'code' => 'required|max:5000'
        ]);


        $language = Language::where('id', $request->language_id)
            ->where('is_active', true)
            ->firstOrFail();


        $response = Http::post('https://emkc.org/api/v2/piston/execute', [
            'language' => $language->name,
            'version' => $language->version,
            'files' => [[
                'name' => 'main',
                'content' => $request->code
            ]],
            'stdin' => $request->stdin ?? ''
        ]);


        return response()->json($response->json());
    }


    public function shareCode(Request $request)
    {
        $shared = SharedCode::create([
            'token'    => Str::random(16),
            'language' => $request->language,
            'code'     => $request->code,
            'stdin'    => $request->stdin
        ]);

        return response()->json([
            'url' => route('frontend.openShared', $shared->token)
        ]);
    }

    public function openShared($token)
    {
        $shared = SharedCode::where('token', $token)->firstOrFail();

        $language = Language::where('runtime', $shared->language)->firstOrFail();
        $languages = Language::where('is_active', true)->get();

        return view('frontend.editor', [
            'language'   => $language,
            'languages'  => $languages,
            'sharedCode' => $shared,
            'fromShare'  => true
        ]);
    }


    public function editor1($slug)
    {

        $landing = LandingPage::first();

        $language = Language::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $languages = Language::where('is_active', true)->get();

        return view('frontend.editor1', compact('language', 'languages', 'landing'));
    }
}
