<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localize', 'localizationRedirect', 'localeSessionRedirect', 'localeViewPath']
    ],
    function () {

        Route::middleware(['auth'])->group(function () {

            Route::get('dashboard', [DashboardController::class, 'index'])
                ->name('dashboard')->middleware('permission:dashboard');

            Route::post('vendor/orders/bulk-status', [DashboardController::class, 'bulkStatus'])
                ->name('vendor.order.bulkStatus');

            // Admin Settings
            Route::middleware(['permission:settings.view'])->group(function () {

                Route::get('settings', [SettingsController::class, 'general'])
                    ->name('settings');

                Route::get('settings/logo', [SettingsController::class, 'logo'])
                    ->name('settings.logo');

                Route::get('settings/contact', [SettingsController::class, 'contact'])
                    ->name('settings.contact');

                Route::post('settings/update', [SettingsController::class, 'update'])
                    ->name('settings.update');
            });


            // Profile
            Route::get('profile', [ProfileController::class, 'index'])
                ->middleware('permission:profile.update')
                ->name('profile');

            Route::put('profile/update', [ProfileController::class, 'update'])
                ->middleware('permission:profile.update')
                ->name('profile.update');

            // Roles
            Route::get('roles', [RoleController::class, 'index'])
                ->middleware('permission:role.view')
                ->name('roles');

            Route::get('roles/create', [RoleController::class, 'create'])
                ->middleware('permission:role.create')
                ->name('roles.create');

            Route::post('roles/store', [RoleController::class, 'store'])
                ->middleware('permission:role.create')
                ->name('roles.store');

            Route::get('roles/{id}/edit', [RoleController::class, 'edit'])
                ->middleware('permission:role.edit')
                ->name('roles.edit');

            Route::put('roles/{id}', [RoleController::class, 'update'])
                ->middleware('permission:role.edit')
                ->name('roles.update');

            Route::delete('roles/{id}', [RoleController::class, 'destroy'])
                ->middleware('permission:role.delete')
                ->name('roles.destroy');


            // Create User
            Route::get('users', [UserController::class, 'index'])
                ->middleware('permission:user.view')
                ->name('users');

            Route::get('users/create', [UserController::class, 'create'])
                ->middleware('permission:user.create')
                ->name('users.create');

            Route::post('users/store', [UserController::class, 'store'])
                ->middleware('permission:user.create')
                ->name('users.store');

            Route::get('users/edit/{id}', [UserController::class, 'edit'])
                ->middleware('permission:user.edit')
                ->name('users.edit');

            Route::put('users/update/{id}', [UserController::class, 'update'])
                ->middleware('permission:user.edit')
                ->name('users.update');

            Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.delete');

            Route::get('users/login-as/{id}', [UserController::class, 'loginAs'])
                ->name('users.loginAs');

            Route::get('users/return-admin', [UserController::class, 'returnAdmin'])
                ->name('users.returnAdmin');

            Route::post('users/update/status/{id}', [UserController::class, 'changeStatus'])
                ->name('users.status');

            Route::get('users/show/{id}', [UserController::class, 'show'])->name('users.show');


        });
    }
);
