<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    //
    protected $table = 'suspensions';

    // Specify the fillable attributes
    protected $fillable = [
        'name',
        'registration_no',
        'class',
        'status',
        'note',
        'start_date',
        'end_date'
    ];
}
