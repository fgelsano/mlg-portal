<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessments';
    protected $fillable = [
        'ay',
        'sem',
        'tuition_fee',
        'misc_fee',
        'total',
        'balance_type',
        'student_id'
    ];

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }
}
