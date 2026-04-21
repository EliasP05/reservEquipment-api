<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\ReservationDetails;
use Carbon\Carbon;

class ReservationService
{
    public static function getReservations()
    {

        $reservations = Reservation::with('user', 'details.equipment')->get();
        return $reservations;
    }
    public static function getReserve($id)
    {
        $reserve = Reservation::with('user', 'details.equipment')->find($id);
        return $reserve;
    }
    public static function getReservationsForId($id)
    {
        $details = ReservationDetails::where('reserv_id', $id);

        return $details;
    }
    public static function create($data)
    {

        $reservation = Reservation::create($data);

        return $reservation;
    }
    public static function updateReservation(Reservation $reservation, $data)
    {

        $reservation->update($data);
        $reservation->save();

        return $reservation;
    }
    public static function activeReserve(Reservation $reservation)
    {

        //pregunta si el campo de inicio reserva esta vacio que modificque hora y estado
        if (!$reservation->start_reserve) {
            $reservation->update(
                [
                    'status' => 'EN CURSO',
                    'start_reserve' => Carbon::now()
                ]
            );
        }

        return $reservation;
    }

    public static function adminEquipment(Reservation $reservation, array $equipments)
    {


        $equipmentsId = collect($equipments)->map(function ($equipment) {
            return is_array($equipment) ? $equipment['id'] : $equipment;
        })->toArray();

        //cambia a estado a ENTREGADO, no vienen del formulario
        ReservationDetails::where('reserv_id', $reservation->id)
            ->whereNotIn('equipment_id', $equipmentsId)
            ->update(['status' => 'ENTREGADO']);

        //cambia a estado a NO ENTREGADO

        foreach ($equipments as $equipment) {
            ReservationDetails::updateOrCreate(
                [
                    'reserv_id' => $reservation->id,
                    'equipment_id' => $equipment,
                ],
                ['status' => 'NO ENTREGADO']
            );
        }
        return ReservationDetails::where('reserv_id', $reservation->id)->get();
    }

    public static function endReservation(Reservation $reservation)
    {
        ReservationDetails::where('reserv_id', $reservation->id)->update(['status' => 'ENTREGADO']);
        $reservation->update(
            [
                'status' => 'COMPLETADO',
                'end_reserve' => Carbon::now()
            ]
        );
        return $reservation;
    }

    public static function deleteReservation($reservation)
    {
        if ($reservation) {
            $reservation->delete();
            return $reservation;
        }
    }
}
