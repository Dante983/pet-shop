<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/admin')->group(function () {
    Route::post('create', [AdminController::class, 'create']);
    Route::post('login', [AdminController::class, 'login']);
});
