<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'detalle',
        'cantidad',
    ];

    protected $table = 'equipments';


    public function details()
    {

        return $this->hasMany(ReservationDetails::class, 'equipment_id');
    }

    public function activeLoan()
    {
        return $this->hasOne(ReservationDetails::class, 'equipment_id')
            ->where('status', 'NO ENTREGADO')
            ->whereHas('reservation', function ($q) {
                $q->whereIn('status', ['EN CURSO']);
            });
    }
}
