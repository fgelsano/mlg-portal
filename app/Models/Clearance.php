<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected $table = 'clearances';
    protected $fillable = [
        'subjectId',
        'studentId',
        'ay',
        'sem'
    ];
}
