<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'title_reserve',
        'description_reserve',
        'date_reserve',
        'hours_reserve',
        'start_reserve',
        'end_reserve',
        'status'
    ];
    protected $table = 'reservations';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function details()
    {
        return $this->hasMany(ReservationDetails::class, 'reserv_id');
    }
}
