<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationDetailsController;
use App\Http\Controllers\UserController;
use App\Models\ReservationDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Rutas publicas
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(

    function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);


        Route::apiResource('/user', UserController::class);
        Route::apiResource('/equipment', EquipmentController::class);
        Route::apiResource('/reservation', ReservationController::class);
        Route::get('/equipmentavailable', [EquipmentController::class, 'getAvailable']);

        Route::PUT('/reservation/{reservation}/activate', [ReservationDetailsController::class, 'store']);
        Route::PUT('/reservation/{reservation}/end', [ReservationDetailsController::class, 'end']);

        Route::post('reservation/loan', [ReservationDetailsController::class, 'startLoan']);
        // Route::GET('/reservation/{id}', [ReservationController::class, 'show']);


    }
);
