<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationDetailsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('/user', UserController::class);
Route::apiResource('/equipment', EquipmentController::class);
Route::apiResource('/reservation', ReservationController::class);
Route::get('/equipmentavailable', [EquipmentController::class, 'getAvailable']);

Route::PUT('/reservation/{reservation}/activate', [ReservationDetailsController::class, 'store']);
Route::PUT('/reservation/{reservation}/end', [ReservationDetailsController::class, 'end']);
