<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $table = 'staffs';
    protected $fillable = [
        
        'role',
        'status',
        'account_name',
        'date_birth',
        'gender',
        'religion',
        'email',
        'phone',
        'position',
        'employment_date',
        'current_address',
        'passport_photo',
        'username',
        'password',
        'qualification'
    ];
}
