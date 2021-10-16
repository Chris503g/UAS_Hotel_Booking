<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_full_name',
        'email',
        'password',
        'birthdate',
        'phone_number',
    ];


}
