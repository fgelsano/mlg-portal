<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = [
        'profile_id',
        'report_card_front',
        'report_card_back',
        'good_moral',
        'psa_birth_cert',
        'med_cert',
        'honorable_dismissal'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}