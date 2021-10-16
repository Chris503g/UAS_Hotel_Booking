<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HotelModel extends Model
{
   public function allData()
   {
       return DB::table('hotels')->get();
   }

   public function getSingleData($id)
   {
       return DB::table('hotels')->where('id', $id)->first();
   }

   public function detailData($id)
   {
       return DB::table('hotels')->where('id', $id)->first();
   }

   public function getBiggestID()
   {
       return DB::table('hotels')
       ->select('id')
       ->orderBy('id', 'desc')
       ->first();
   }

   public function addData($data)
   {
       DB::table('hotels')->insert($data);
   }

   public function editData($id, $data)
   {
       DB::table('hotels')
       ->where('id', $id)
       ->update($data);
   }

   public function deleteData($id)
   {
       DB::table('hotels')
       ->where('id', $id)
       ->delete();
   }
}
