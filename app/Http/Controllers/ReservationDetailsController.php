<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Http\Requests\ReservationDetailsRequest;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationDetailsController extends Controller
{
    public function show($id)
    {
        $details = ReservationService::getReservationsForId($id);

        if (!$details) {
            return response()->json(['message' => 'error'], 400);
        }
        return $details;
    }
    public function store(Reservation $reservation, ReservationDetailsRequest $request)
    {
        $encabezado = ReservationService::activeReserve($reservation);

        if (!$encabezado) {
            return response()->json(['message' => 'error'], 400);
        } else {
            $detail = ReservationService::adminEquipment($reservation,  $request->validated()['equipments']);
        }
        return response()->json($detail);
    }

    public function end(Reservation $reservation)
    {
        $detail = ReservationService::endReservation($reservation);
        if (!$detail) {
            return response()->json(['message' => 'error'], 400);
        }
        return response()->json($detail);
    }


    //metodo reserva+prestamo con rollback
    public function startLoan(LoanRequest $request)
    {
        $data = $request->except('equipments');
        // el responsable es siempre el usuario autenticado, no lo define el cliente
        $data['user_id'] = $request->user()->id;
        $equipments = $request->input('equipments', []);
        $loan = ReservationService::startLoan($data, $equipments);
        // Verificá que llegan bien
        // return response()->json([
        //     'reservation' => $data,
        //     'equipments' => $equipments,
        // ]);

        if (!$loan) {
            return response()->json(['message' => 'error'], 400);
        }
        return response()->json($loan);
    }
}
