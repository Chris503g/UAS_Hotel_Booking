<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public function allData()
    {
        return DB::table('users')->get();
    }

    // get detail data based on users database table 'id'
    public function detailData($id)
    {
        return DB::table('users')->where('id', $id)->first();
    }

    public function getBiggestID()
    {
        return DB::table('users')
        ->select('id')
        ->orderBy('id', 'desc')
        ->first();
    }
    
    public function addData($data)
    {
        DB::table('users')->insert($data);
    }

    public function editData($id, $data)
    {
        DB::table('users')
        ->where('id', $id)
        ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('users')
        ->where('id', $id)
        ->delete();
    }

}