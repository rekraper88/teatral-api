<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::resource('/companies', CompanyController::class)->middleware('auth');

require __DIR__.'/auth.php';
