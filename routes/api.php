<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware(['guest:api'])->group(function () {
            Route::post('create', [AdminController::class, 'create']);
            Route::post('login', [AdminController::class, 'login']);
        });

        Route::middleware(['auth:jwt'])->group(function () {
            Route::get('logout', [AdminController::class, 'logout']);
        });
    });
});
