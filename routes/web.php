<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::resource('/companies', CompanyController::class)->middleware('auth');
Route::resource('/rooms', RoomController::class)->middleware('auth');

require __DIR__.'/auth.php';
