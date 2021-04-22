<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $table = 'deductions';
    protected $fillable = [
        'student_id',
        'ay',
        'sem',
        'deduction_name',
        'amount',
        'assessment_id'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
