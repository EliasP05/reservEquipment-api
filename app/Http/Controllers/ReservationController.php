<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\reservation;
use App\Services\ReservationService;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations=ReservationService::getReservations();

        if(!$reservations){
            return response()->json(['message'=>'error',404]);

        }
        return response()->json($reservations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(ReservationRequest $request)
    {
       $reservation= ReservationService::create($request->validated());

         if(!$reservation){
            return response()->json(['message'=>'error',400]);
        }
                return response()->json($reservation);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationRequest $data, reservation $reservation)
    {
        $reservation = ReservationService::updateReservation($reservation , $data->validated());
        if(!$reservation){
            return response()->json(['message'=>'error',400]);
        }
        return response()->json($reservation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reservation $reservation)
    {
        $reserveDelete= ReservationService::deleteReservation($reservation);

        if(!$reserveDelete){
            return response()->json(['message'=>'error',400]);
        }
        return response()->json($reserveDelete);
    }
}
