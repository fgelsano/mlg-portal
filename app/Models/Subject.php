<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'code',
        'description',
        'category',
        'instructor_id',
        'schedule',
        'sy',
        'sem'
    ];

    public function enrollment()
    {
        return $this->belongsTo('App\Models\Enrollment');
    }
}
