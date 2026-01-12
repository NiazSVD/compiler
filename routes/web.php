<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

require __DIR__ . '/auth.php';
require __DIR__ . '/backend.php';

Route::prefix('admin')->middleware(['auth'])->group(function () {


    Route::get('languages', [LanguageController::class,'index'])
    ->name('admin.languages.index');


    Route::get('languages/create', [LanguageController::class,'create'])
    ->name('admin.languages.create');


    Route::post('languages', [LanguageController::class,'store'])
    ->name('admin.languages.store');


    Route::get('languages/{language}/edit', [LanguageController::class,'edit'])
    ->name('admin.languages.edit');


    Route::put('languages/{language}', [LanguageController::class,'update'])
    ->name('admin.languages.update');


    Route::delete('languages/{language}', [LanguageController::class,'destroy'])
    ->name('admin.languages.destroy');


    // Sync from Piston API
    Route::post('languages/sync-piston', [LanguageController::class,'syncPiston'])
    ->name('admin.languages.sync');


    Route::get('/admin/landing-page', [LandingPageController::class, 'index'])
    ->name('admin.landing.index');

    Route::post('/admin/landing-page', [LandingPageController::class, 'update'])
        ->name('admin.landing.update');
});


Route::get('/', [FrontendController::class,'home'])->name('frontend.home');
Route::get('/{slug}', [FrontendController::class, 'editor'])->name('frontend.editor');

Route::post('/run', [FrontendController::class,'runCode'])->name('frontend.run');


Route::post('/share-code', [FrontendController::class, 'shareCode'])->name('frontend.shareCode');
Route::get('/share/{token}', [FrontendController::class, 'openShared'])->name('frontend.openShared');









