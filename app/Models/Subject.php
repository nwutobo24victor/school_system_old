<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    //
    use HasFactory;

    protected $table = 'subjects';

    // Specify the fillable attributes
    protected $fillable = [
        'class',
        'teacher',
        'type',
        'pass_mark',
        'total_mark',
        'subject',
        'subject_code',
    ];
}
