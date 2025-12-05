<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function store(EquipmentRequest $request)
    {

        $equipment = EquipmentService::create($request->validated());

        if (!$equipment) {
            return response()->json(['message' => 'error', 404]);
        }
        return response()->json($equipment);
    }

    public function index()
    {
        $equipments = EquipmentService::getEquipment();

        if (!$equipments) {
            return response()->json(['message' => 'error', 404]);
        }

        return response()->json($equipments);
    }
    //equipos disponibles
    public function getAvailable()
    {
        $equipments = EquipmentService::getEquipmentAvailable();

        if (!$equipments) {
            return response()->json(['message' => 'error', 404]);
        }
        return response()->json($equipments);
    }
    public function update(Equipment $equipment, EquipmentRequest $data)
    {
        try {
            $updatEquipment = EquipmentService::updateEquipment($equipment, $data->validated());

            if (!$updatEquipment) {
                return response()->json(['message' => 'No se puede modificar el registro por que esta asociado a un reserva activa'], 400);
            }

            return response()->json($updatEquipment);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No se puede eliminar el registro porque está asociado a una reserva.'
            ], 400);
        }
    }

    public function destroy(Equipment $equipment)
    {
        try {
            $deletEquipment = EquipmentService::deleteEquipment($equipment);

            if (!$deletEquipment) {

                return response()->json(['message' => 'No se puede eliminar el registro porque está asociado a una reserva.'], 400);
            }

            return response()->json($deletEquipment);
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'foreign key constraint fails')) {
                return response()->json([
                    'message' => 'No se puede eliminar el registro porque está asociado a una reserva.'
                ], 400);
            }
        }
    }
}
