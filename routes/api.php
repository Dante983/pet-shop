<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/admin')->group(function () {
    Route::middleware(['guest:api'])->group(function () {
        Route::group('admin', function () {
            Route::post('create', [AdminController::class, 'create']);
            Route::post('login', [AdminController::class, 'login']);
            Route::get('logout', [AdminController::class, 'logout']);
        });
    });
});
