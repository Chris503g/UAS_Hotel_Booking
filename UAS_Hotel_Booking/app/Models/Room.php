<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $fillables = [
        'room_id',
        'hotel_id', 
        'room_name',
        'price_per_day',
        'available_room_qty'
    ];


}
