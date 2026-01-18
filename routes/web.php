<?php

use App\Http\Controllers\DynamicHomeController;
use App\Http\Controllers\DynamicPageController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

require __DIR__ . '/auth.php';
require __DIR__ . '/backend.php';

Route::prefix('admin')->middleware(['auth'])->group(function () {


    Route::get('languages', [LanguageController::class, 'index'])->name('admin.languages.index');
    Route::get('languages/create', [LanguageController::class, 'create'])->name('admin.languages.create');
    Route::post('languages', [LanguageController::class, 'store'])->name('admin.languages.store');
    Route::get('languages/{language}/edit', [LanguageController::class, 'edit'])->name('admin.languages.edit');
    Route::put('languages/{language}', [LanguageController::class, 'update'])->name('admin.languages.update');
    Route::delete('languages/{language}', [LanguageController::class, 'destroy'])->name('admin.languages.destroy');

    // Sync from Piston API
    Route::post('languages/sync-piston', [LanguageController::class, 'syncPiston'])->name('admin.languages.sync');

    //landing page routes
    Route::get('landing-page', [LandingPageController::class, 'index'])->name('admin.landing.index');
    Route::post('landing-page', [LandingPageController::class, 'update'])->name('admin.landing.update');

    //dynamic page routes
    Route::get('dynamic-pages', [DynamicPageController::class, 'index'])->name('admin.dynamic_page.index');
    Route::get('dynamic-page-create', [DynamicPageController::class, 'create'])->name('admin.dynamic_page.create');
    Route::post('dynamic-page-store', [DynamicPageController::class, 'store'])->name('admin.dynamic_page.store');
    Route::get('dynamic-page-edit/{id}', [DynamicPageController::class, 'edit'])->name('admin.dynamic_page.edit');
    Route::post('dynamic-page-update/{id}', [DynamicPageController::class, 'update'])->name('admin.dynamic_page.update');
    Route::delete('dynamic-page-delete/{id}', [DynamicPageController::class, 'delete'])->name('admin.dynamic_page.delete');


    //dynamic home page
    Route::get('dynamic-home-page', [DynamicHomeController::class, 'index'])->name('admin.dynamic_home.index');
    Route::post('dynamic-home-page-update', [DynamicHomeController::class, 'updateHome'])->name('admin.dynamic_home.update');


    Route::get('/menu-builder', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('/menu-builder/store', [MenuController::class, 'store'])->name('admin.menu.store');
    Route::get('/menu-builder/edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
    Route::post('/menu-builder/update/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/menu-builder/delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete');
});



//Frontend routes start here
// Route::get('/', [FrontendController::class,'home'])->name('frontend.home');

Route::get('/', [FrontendController::class, 'index'])->name('home');




Route::get('/editor/1/{slug}', [FrontendController::class, 'editor1'])->name('frontend.editor1');


Route::get('/{slug}', [FrontendController::class, 'editor'])->name('frontend.editor');

Route::post('/run', [FrontendController::class, 'runCode'])->name('frontend.run');


Route::post('/share-code', [FrontendController::class, 'shareCode'])->name('frontend.shareCode');
Route::get('/share/{token}', [FrontendController::class, 'openShared'])->name('frontend.openShared');
