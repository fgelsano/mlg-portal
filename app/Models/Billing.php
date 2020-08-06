<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billings';
    protected $fillable = [
        'enrollment_id',
        'fee',
        'amount'
    ];
}
