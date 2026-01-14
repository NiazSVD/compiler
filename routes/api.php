<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;

    Route::get('/home', [ApiController::class, 'index'])->name('frontend.home.api');
