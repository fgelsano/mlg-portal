<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'profile_id',
        'type',
        'amount',
        'balance',
        'or_number',
        'ref_number',
        'others'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function admission()
    {
        return $this->belongsTo('App\Models\Admission');
    }
}
