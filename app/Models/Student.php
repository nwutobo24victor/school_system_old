<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $fillable = [

        'status',
        'surname',
        'othernames',
        'guardian',
        'date_birth',
        'gender',
        'blood_group',
        'religion',
        'email',
        'phone',
        'current_address',
        'nationality',
        'state_origin',
        'local_govt_area',
        'permanent_address',
        'class',
        'section',
        'department',
        'registration_no',
        'admission_date',
        'passport_photo',
        'remark',
        'username',
        'password',

    ];
}
