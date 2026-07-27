<?php

namespace App\Services;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use App\Models\Reservation;
use App\Models\ReservationDetails;

class EquipmentService
{

    public static function create($data)
    {


        $equipment = Equipment::create($data);


        return $equipment;
    }

    public static function getEquipment()
    {

        //$equipments = Equipment::get()->all();

        $equipments = Equipment::with([
            'activeLoan.reservation'
        ])->get();

        return $equipments;
    }

    //equipos disponibles
    public static function getEquipmentAvailable()
    {
        $reservas = Reservation::where('status', 'EN CURSO')->pluck('id');
        $equiposOcupados = ReservationDetails::whereIn('reserv_id', $reservas)
            ->where('status', 'NO ENTREGADO')
            ->pluck('equipment_id');
        $equipments = Equipment::whereNotIn('id', $equiposOcupados)->get();

        return $equipments;
    }

    public static function updateEquipment(Equipment $equipment, $data)
    {
        try {

            $reservationsDetail = ReservationDetails::where('equipment_id', $equipment->id)
                ->where('status', 'No entregado')
                ->get();

            if ($reservationsDetail->isEmpty()) {
                $equipment->update($data);

                return true;
            }

            return false;
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
            \Log::error("Error al modificar equipo:" . $e->getMessage());
            throw $e;
        }
    }

    public static function deleteEquipment(Equipment $equipment)
    {

        try {
            if ($equipment) {
                $equipment->delete();
                return true;
            }
            return false;
        } catch (\Illuminate\Database\QueryException $e) {

            if (str_contains($e->getMessage(), 'foreign key constraint fails')) {
                return false;
            }

            \Log::error("Error al eliminar equipo:" . $e->getMessage());
            throw $e;
        }
    }
}
