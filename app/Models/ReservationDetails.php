<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationDetails extends Model
{
    protected $fillable=[
        'reserv_id',
        'equipment_id',
        'status'
    ];
    protected $table ="reserve_details";

    function equipment (){
        return $this->BelongsTo(Equipment::class, 'equipment_id');
    }

    function reservation(){
        return $this->belongsTo(Reservation::class, 'reserv_id');
    }
}
