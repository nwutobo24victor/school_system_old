<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    //
    protected $table = 'timetables';

    // Specify the fillable attributes
    protected $fillable = [
        'school_year',
        'term',
        'class',
        'section',
        'subject',
        'day',
        'teacher',
        'starting_time',
        'ending_time',
        'room'
    ];
}
