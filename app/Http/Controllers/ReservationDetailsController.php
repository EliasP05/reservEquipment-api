<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationDetailsRequest;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationDetailsController extends Controller
{
    public function show($id)
    {
        $details = ReservationService::getReservationsForId($id);

        if (!$details) {
            return response()->json(['message' => 'error', 400]);
        }
        return $details;
    }
    public function store(Reservation $reservation, ReservationDetailsRequest $request)
    {
        $detail = ReservationService::activeReserve($reservation, $request->validated());

        if (!$detail) {
            return response()->json(['message' => 'error', 400]);
        }
        return response()->json($detail);
    }

    public function end(Reservation $reservation)
    {
        $detail = ReservationService::endReservation($reservation);
        if (!$detail) {
            return response()->json(['message' => 'error', 400]);
        }
        return response()->json($detail);
    }
}
