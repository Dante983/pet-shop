<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/admin/create', [AdminController::class, 'create']);
});
