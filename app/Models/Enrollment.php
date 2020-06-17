<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';
    protected $fillable = [
        'profile_id',
        'subject_id',
        'course',
        'year_level',
        'status'
    ];
}
