<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomModel extends Model
{
    protected $fillables = [
        'room_id',
        'hotel_id', 
        'room_name',
        'price_per_day',
        'available_room_qty'
    ];
    
    public function allData()
    {
        return DB::table('rooms')->get();
    }

    // get detail data based on room database table 'room_id'
    public function detailData($room_id)
    {
        return DB::table('rooms')->where('room_id', $room_id)->first();
    }

    public function getBiggestID()
    {
        return DB::table('rooms')
        ->select('room_id')
        ->orderBy('room_id', 'desc')
        ->first();
    }

    public function addData($data)
    {
        DB::table('rooms')->insert($data);
    }

    public function editData($room_id, $data)
    {
        DB::table('rooms')
        ->where('room_id', $room_id)
        ->update($data);
    }

    public function deleteData($room_id)
    {
        DB::table('rooms')
        ->where('room_id', $room_id)
        ->delete();
    }

}
