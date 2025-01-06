<?php

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

Route::post('/change_company', [PlayController::class, 'change_company']);
Route::get('/get_schedules_for_room', [PlayController::class, 'get_schedules_for_room']);

require __DIR__.'/auth.php';
