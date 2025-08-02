<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    //
    use HasFactory;

    protected $table = 'classes';

    // Specify the fillable attributes
    protected $fillable = [
        'class',
        'class_number',
        'teacher',
        'note',
    ];
}
