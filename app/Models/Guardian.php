<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    //
    protected $table = 'guardians';
    protected $fillable = [
        
        'status',
        'account_name',
        'father_name',
        'mother_name',
        'father_profession'.
        'mother_profession',
        'email',
        'phone',
        'current_address',
        'passport_photo',
        'username',
        'password',

    ];
}
