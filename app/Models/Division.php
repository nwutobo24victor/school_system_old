<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    //
    use HasFactory;

    protected $table = 'divisions';

    // Specify the fillable attributes
    protected $fillable = [
        'title',
        'class',
        'category',
        'capacity',
        'note',
    ];
}
