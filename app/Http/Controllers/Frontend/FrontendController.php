<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Language;
use App\Models\SharedCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function home()
    {
        $languages = Language::where('is_active', true)
            ->orderBy('display_name')
            ->get();

        $defaultLanguage = Language::where('is_default', true)->first();
        $landing = LandingPage::first();

        return view('frontend.home', compact('languages', 'defaultLanguage','landing'));
    }

    public function editor($slug)
    {
        $landing = LandingPage::first();

        $language = Language::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $languages = Language::where('is_active', true)->get();

        return view('frontend.editor', compact('language', 'languages', 'landing'));
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
}
