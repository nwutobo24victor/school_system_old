<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignments';

    // Specify the fillable attributes
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'class',
        'section',
        'subject',
        'assignment_file',
    ];
}
