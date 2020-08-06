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
        'academic_year',
        'semester',
        'status'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function subject()
    {
        return $this->hasOne('App\Models\Subject');
    }
}
