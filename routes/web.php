<?php

use App\Http\Controllers\CarteleraController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::resource('/companies', CompanyController::class)->middleware('auth');
Route::resource('/rooms', RoomController::class)->middleware('auth');
Route::resource('/plays', PlayController::class)->middleware('auth');
Route::resource('/schedules', ScheduleController::class)->middleware('auth');

Route::get('/cartelera', [CarteleraController::class, 'index']);
Route::post('/cartelera', [CarteleraController::class, 'store'])->middleware('auth');
Route::delete('/cartelera/{cartelera}', [CarteleraController::class, 'destroy'])->name('cartelera.delete')->middleware('auth');

Route::post('/change_company', [PlayController::class, 'change_company']);
Route::get('/get_schedules_for_room', [PlayController::class, 'get_schedules_for_room']);

require __DIR__.'/auth.php';
