<?php

namespace App\Services;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\ReservationDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    public static function getReservations()
    {

        $reservations = Reservation::with('user', 'details.equipment')->get();
        return $reservations;
    }
    public static function getReserve(Reservation $id)
    {
        $reserve = Reservation::with('user', 'details.equipment')->find($id);
        return $reserve;
    }
    public static function getReservationsForId(Reservation $id)
    {
        $details = ReservationDetails::where('reserv_id', $id);

        return $details;
    }
    public static function create(ReservationRequest $data)
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


    //iniciar prestamo sin reserva
    public static function startLoan(array $data, array $equipments)
    {

        //usar rol back. insertar reserva, con el id de reserva insertarmos datos ne la tabla detalles

        DB::beginTransaction();

        try {

            $reservation = Reservation::create([
                'user_id' => $data['user_id'],
                'title_reserve' => $data['title_reserve'],
                'description_reserve' => $data['description_reserve'],
                'date_reserve' => $data['date_reserve'],
                'hours_reserve' => $data['hours_reserve'],
                'status' => $data['status']
            ]);
            if ($reservation) {
                foreach ($equipments as $equipment) {
                    ReservationDetails::create(
                        [
                            'reserv_id' => $reservation->id,
                            'equipment_id' => $equipment['id'],
                            'status' => 'NO ENTREGADO'
                        ],
                    );
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e; // o return false para que el controlador devuelva 400
        }
    }
}
