<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingModel extends Model
{
    public function allData()
    {
        return DB::table('bookings')->get();
    }

    // get detail data based on booking database table 'booking_id'
    public function detailData($booking_id)
    {
        return DB::table('bookings')->where('booking_id', $booking_id)->first();
    }

    public function getBiggestID()
    {
        return DB::table('bookings')
        ->select('booking_id')
        ->orderBy('booking_id', 'desc')
        ->first();
    }

    public function addData($data)
    {
        DB::table('bookings')->insert($data);
    }

    public function editData($booking_id, $data)
    {
        DB::table('bookings')
        ->where('booking_id', $booking_id)
        ->update($data);
    }

    public function deleteData($booking_id)
    {
        DB::table('bookings')
        ->where('booking_id', $booking_id)
        ->delete();
    }

}
