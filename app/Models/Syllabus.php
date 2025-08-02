<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    //
    protected $table = 'syllabuses';

    // Specify the fillable attributes
    protected $fillable = [
        'class',
        'title',
        'description',
        'uploader',
        'syllabus_file',
    ];
}
